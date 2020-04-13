<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use App\Model\SpintaxInput;
use App\Model\SpintaxOutput;


class SpintaxController extends Controller
{
    public function index($target_id)
    {
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


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            // request validation
            $this->validate($request, [
                'target_id' => 'required',
                'spintax' => 'required'
            ]);

            $spintaxOutput = new spintaxOutput();
            $spintaxOutput->spintax = $request->spintax;
            $spintaxOutput->target_id = $request->target_id;
            $spintaxOutput->save();

            DB::commit();
            Toastr::success('New spintax has been created', 'Success');
        } catch (\Exception $error) {
            DB::rollBack();
            Toastr::error('Something went wrong. Please try again!', 'Error');
        }
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            // request validation
            $this->validate($request, [
                'target' => 'required',
            ]);

            $spintaxOutput = spintaxOutput::find($id);
            if (!$spintaxOutput) {
                Toastr::error('Spintax doesn\'t exist!', 'Error');
                return redirect()->back();
            }

            $spintaxOutput->spintax = $request->spintax;
            $spintaxOutput->target_id = $request->target_id;
            $spintaxOutput->save();

            DB::commit();
            Toastr::success('Spintax has been updated', 'Success');
        } catch (\Exception $error) {
            DB::rollBack();
            dd($error);
            Toastr::error('Something went wrong. Please try again!', 'Error');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $spintaxOutput = spintaxOutput::find($id);
        if (!$spintaxOutput) {
            Toastr::error('Spintax doesn\'t exist!', 'Error');
            return redirect()->back();
        }

        $spintaxOutput->delete();
        Toastr::success('Spintax has been deleted!', 'Success');
        return redirect()->back();
    }
}
