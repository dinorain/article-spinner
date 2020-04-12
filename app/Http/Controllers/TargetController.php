<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TargetController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::commit();
            Toastr::success('', 'Success');
        } catch (\Exception $error) {
            DB::rollBack();
            Toastr::error('', 'Error');
        }
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            DB::commit();
            Toastr::success('', 'Success');
        } catch (\Exception $error) {
            DB::rollBack();
            Toastr::error('', 'Error');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        return redirect()->back();
    }
}
