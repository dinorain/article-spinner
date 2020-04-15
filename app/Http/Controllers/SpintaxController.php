<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Excel;

use App\Model\SpintaxInput;
use App\Model\SpintaxOutput;


class SpintaxController extends Controller
{

    private function cleanAndParseExcel($doc, $target, $targetSynonymsDict)
    {
        $sheet = $doc->getSheet(0);
        $rows = [];
        $rowIndex = 2;
        while (1) {
            $synonym = strtolower(ExcelHelper::cleanText($sheet->getCellByColumnAndRow(0, $rowIndex)->getValue()));

            if (!$synonym) break;
            else if ($synonym == $target)
                return ['isError' => true, 'message' => "Synonym cannot be as same as its target! (Cell {$rowIndex}A)"];
            else if (array_key_exists($synonym, $targetSynonymsDict))
                return ['isError' => true, 'message' => "Synonym '$synonym' has existed! (Cell {$rowIndex}A)"];

            array_push($rows, [$synonym]);
            $rowIndex++;
        }
        return ['isError' => false, 'rows' => $rows];
    }

    public function index($target_id)
    {
        if (Auth::check()) {
            $spintaxInput = SpintaxInput::find($target_id);
            if (!$spintaxInput) {
                Toastr::error('Spintax target doesn\'t exist!', 'Error');
                return redirect()->back();
            }

            $spintaxCollections = SpintaxOutput::where('target_id', $target_id)->get();

            $data = [
                'spintaxInput' => $spintaxInput,
                'spintaxCollections' => $spintaxCollections
            ];

            return view('pages.admin.spintax')->with($data);
        }
        else {
            return response()->json(['error' => 'Not authorized'], 404);
        }
    }


    public function store(Request $request, $target_id)
    {

        if (Auth::check()) {
            try {
                DB::beginTransaction();

                // request validation
                $this->validate($request, [
                    'target_id' => 'required',
                    'spintax' => 'required'
                ]);

                $spintaxTarget = SpintaxInput::find($target_id);
                if (strtolower($request->spintax) == $spintaxTarget->target) {
                    Toastr::error('Synonym cannot be as same as its target!', 'Error');
                    return redirect()->back();
                }

                $spintaxOutput = SpintaxOutput::where('spintax', $request->spintax)->where('target_id', $target_id)->first();
                if ($spintaxOutput) {
                    Toastr::error('Synonym has existed!', 'Error');
                    return redirect()->back();
                }

                $spintaxOutput = new SpintaxOutput();
                $spintaxOutput->spintax = strtolower($request->spintax);
                $spintaxOutput->target_id = $target_id;
                $spintaxOutput->save();

                DB::commit();
                Toastr::success('New synonym has been created', 'Success');
            } catch (\Exception $error) {
                DB::rollBack();
                Toastr::error('Something went wrong. Please try again!', 'Error');
            }
            return redirect()->back();
        }
        else {
            return response()->json(['error' => 'Not authorized'], 404);
        }
    }

    public function update(Request $request, $target_id, $id)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                // request validation
                $this->validate($request, [
                    'target_id' => 'required',
                    'spintax' => 'required'
                ]);

                $spintaxTarget = SpintaxInput::find($target_id);
                if (strtolower($request->spintax) == $spintaxTarget->target) {
                    Toastr::error('Synonym cannot be as same as its target!', 'Error');
                    return redirect()->back();
                }

                $spintaxOutput = SpintaxOutput::where('spintax', $request->spintax)->where('target_id', $target_id)->first();
                if ($spintaxOutput) {
                    Toastr::error('Synonym has existed!', 'Error');
                    return redirect()->back();
                }

                $spintaxOutput = SpintaxOutput::find($id);
                if (!$spintaxOutput) {
                    Toastr::error('Synonym doesn\'t exist!', 'Error');
                    return redirect()->back();
                }

                $spintaxOutput->spintax = strtolower($request->spintax);
                $spintaxOutput->target_id = $target_id;
                $spintaxOutput->save();

                DB::commit();
                Toastr::success('Synonym has been updated', 'Success');
            } catch (\Exception $error) {
                DB::rollBack();
                Toastr::error('Something went wrong. Please try again!', 'Error');
            }
            return redirect()->back();
        }
        else {
            return response()->json(['error' => 'Not authorized'], 404);
        }
    }

    public function destroy($target_id, $id)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();
                $spintaxOutput = SpintaxOutput::find($id);
                if (!$spintaxOutput) {
                    Toastr::error('Synonym doesn\'t exist!', 'Error');
                    return redirect()->back();
                }

                $spintaxOutput->delete();
                DB::commit();
                Toastr::success('Synonym has been deleted!', 'Success');
            } catch (\Exception $error) {
                DB::rollBack();
                Toastr::error('Something went wrong. Please try again!', 'Error');
            }
            return redirect()->back();
        }
        else {
            return response()->json(['error' => 'Not authorized'], 404);
        }
    }

    public function uploadSpintaxCollectionsExcel(Request $request, $id)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                // request validation
                $this->validate($request, [
                    'excelFile' => 'required',
                ]);
                $excelFile = $request->file('excelFile');
                $extension = $excelFile->getClientOriginalExtension();
                $check = in_array($extension, ['xlsx', 'xls'], true);

                if (!$check) {
                    Toastr::error('File extension must be xlsx or xls only', 'Fail');
                    return redirect('/openSesame/targets/'.$id.'/spintax');
                } else if ($excelFile->getSize() > 5 * 1000000) {
                    Toastr::error('File size must not exceed 5MB!', 'Fail');
                    return redirect('/openSesame/targets/'.$id.'/spintax');
                }

                $doc = Excel::load($excelFile);
                // delete tmp file
                unlink($excelFile->getRealPath());

                $target = SpintaxInput::where('id', $id)->first();

                // fetch synonyms
                $spintaxOutput = SpintaxOutput::where('target_id', $id)->get();
                $targetSynonymsDict = [];
                foreach ($spintaxOutput as $so)
                    $targetSynonymsDict[$so->spintax] = true;

                // clean and parse
                $result = $this->cleanAndParseExcel($doc, $target, $targetSynonymsDict);
                if ($result['isError']) {
                    flash('Error. '.$result['message'])->error();
                    // Toastr::error($result['message'], 'Error');
                    return redirect('/openSesame/targets/'.$id.'/spintax');
                } else {
                    // create spintax collections
                    $rows = $result['rows'];
                    for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                        $row = $rows[$rowIndex];
                        $spintaxOutput = new SpintaxOutput();
                        $spintaxOutput->spintax = $row[0];
                        $spintaxOutput->target_id = $id;
                        $spintaxOutput->save();
                    }
                    $rowsCount = count($rows);

                    DB::commit();
                    Toastr::success("Excel file has been successfully uploaded ($rowsCount rows processed).", 'Success');
                    return redirect('/openSesame/targets/'.$id.'/spintax');
                }
            } catch (\Exception $error) {
                DB::rollBack();
                if($error->errorInfo[2]) flash('Error. '.$error->errorInfo[2]. 'Please try again!')->error();
                Toastr::error('Something went wrong. Please try again!', 'Error');
            }
            return redirect('/openSesame/targets/'.$id.'/spintax');
        }
        else {
            return response()->json(['error' => 'Not authorized'], 404);
        }
    }

}
