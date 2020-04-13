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


class TargetController extends Controller
{
    public function index()
    {
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


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            // request validation
            $this->validate($request, [
                'target' => 'required'
            ]);

            $spintaxInput = new SpintaxInput();
            $spintaxInput->target = $request->target;
            $spintaxInput->save();

            DB::commit();
            Toastr::success('New spintax target has been created', 'Success');
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

            $spintaxInput = SpintaxInput::find($id);
            if (!$spintaxInput) {
                Toastr::error('Spintax target doesn\'t exist!', 'Error');
                return redirect()->back();
            }

            $spintaxInput->target = $request->target;
            $spintaxInput->save();

            DB::commit();
            Toastr::success('Spintax target has been updated', 'Success');
        } catch (\Exception $error) {
            DB::rollBack();
            dd($error);
            Toastr::error('Something went wrong. Please try again!', 'Error');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $spintaxInput = SpintaxInput::find($id);
        if (!$spintaxInput) {
            Toastr::error('Spintax target doesn\'t exist!', 'Error');
            return redirect()->back();
        }

        $spintaxCollections = SpintaxOutput::where('target_id', $id)->get();
        foreach ($spintaxCollections as $sc) $sc->delete();

        $spintaxInput->delete();
        Toastr::success('Spintax target has been deleted!', 'Success');
        return redirect()->back();
    }
}
