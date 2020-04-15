<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Excel;

use App\Model\SpintaxInput;
use App\Model\SpintaxOutput;


class TargetController extends Controller
{
    private function cleanAndParseExcel($doc, $targetNamesDict)
    {
        $sheet = $doc->getSheet(0);
        $rows = [];
        $rowIndex = 2;
        while (1) {
            $target = strtolower(ExcelHelper::cleanText($sheet->getCellByColumnAndRow(0, $rowIndex)->getValue()));

            if (!$target) break;
            else if (array_key_exists($target, $targetNamesDict))
                return ['isError' => true, 'message' => "Spintax target has existed. (Cell {$rowIndex}A)!"];

            array_push($rows, [$target]);
            $rowIndex++;
        }
        return ['isError' => false, 'rows' => $rows];
    }

    public function index()
    {
        if (Auth::check()) {
            $inputs = SpintaxInput::all();

            $spintaxCollections = SpintaxOutput::orderBy('spintax', 'ASC')->get();
            $spintaxTargetIdDict = [];

            foreach ($inputs as $i) $spintaxTargetIdDict[$i->id] = '';
            foreach ($spintaxCollections as $sc)
                $spintaxTargetIdDict[$sc->target_id] =
                    $spintaxTargetIdDict[$sc->target_id] === '' ?
                        $spintaxTargetIdDict[$sc->target_id].$sc->spintax : $spintaxTargetIdDict[$sc->target_id].'|'.$sc->spintax;

            $data = [
                'inputs' => $inputs,
                'spintaxTargetIdDict' => $spintaxTargetIdDict
            ];

            return view('pages.admin.index')->with($data);
        }
        else {
            return response()->json(['error' => 'Not authorized'], 404);
        }
    }


    public function store(Request $request)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                // request validation
                $this->validate($request, [
                    'target' => 'required'
                ]);

                $spintaxInput = SpintaxInput::where('target', $request->target)->first();
                if ($spintaxInput) {
                    Toastr::error('Spintax target has existed!', 'Error');
                    return redirect()->back();
                }

                $spintaxInput = new SpintaxInput();
                $spintaxInput->target = strtolower($request->target);
                $spintaxInput->save();

                DB::commit();
                Toastr::success('New spintax target has been created', 'Success');
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

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                // request validation
                $this->validate($request, [
                    'target' => 'required',
                ]);

                $spintaxInput = SpintaxInput::find($id);
                if (!$spintaxInput) {
                    Toastr::error('Spintax target doesn\'t exist!', 'Error');
                    return redirect()->back();
                }

                $spintaxInput = SpintaxInput::where('target', $request->target)->where('id', '!=', $id)->first();
                if ($spintaxInput) {
                    Toastr::error('Spintax target has existed!', 'Error');
                    return redirect()->back();
                }

                $spintaxInput->target = strtolower($request->target);
                $spintaxInput->save();

                DB::commit();
                Toastr::success('Spintax target has been updated', 'Success');
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

    public function destroy($id)
    {
        if (Auth::check()) {
            try {
                $spintaxInput = SpintaxInput::find($id);
                if (!$spintaxInput) {
                    Toastr::error('Spintax target doesn\'t exist!', 'Error');
                    return redirect()->back();
                }

                $spintaxCollections = SpintaxOutput::where('target_id', $id)->get();
                foreach ($spintaxCollections as $sc) $sc->delete();

                $spintaxInput->delete();

                DB::commit();
                Toastr::success('Spintax target has been deleted!', 'Success');
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

    public function uploadTargetsExcel(Request $request)
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
                    return redirect('/openSesame/targets');
                } else if ($excelFile->getSize() > 5 * 1000000) {
                    Toastr::error('File size must not exceed 5MB!', 'Fail');
                    return redirect('/openSesame/targets');
                }

                $doc = Excel::load($excelFile);
                // delete tmp file
                unlink($excelFile->getRealPath());

                // fetch targets
                $spintaxInputs = SpintaxInput::all();
                $targetNamesDict = [];
                foreach ($spintaxInputs as $si)
                    $targetNamesDict[$si->target] = true;

                // clean and parse
                $result = $this->cleanAndParseExcel($doc, $targetNamesDict);
                if ($result['isError']) {
                    Toastr::error($result['message'], 'Error');
                    return redirect('/openSesame/targets');
                } else {
                    // create spintax targets
                    $rows = $result['rows'];
                    for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                        $row = $rows[$rowIndex];
                        $spintaxInput = new SpintaxInput();
                        $spintaxInput->target = $row[0];
                        $spintaxInput->save();
                    }
                    $rowsCount = count($rows);

                    DB::commit();
                    Toastr::success("Excel file has been successfully uploaded ($rowsCount rows processed).", 'Success');
                    return redirect('/openSesame/targets');
                }
            } catch (\Exception $error) {
                DB::rollBack();
                if($error->errorInfo[2]) flash('Error. '.$error->errorInfo[2]. 'Please try again!')->error();
                Toastr::error('Something went wrong. Please try again!', 'Error');
            }
            return redirect('/openSesame/targets');
        }
        else {
            return response()->json(['error' => 'Not authorized'], 404);
        }
    }

}
