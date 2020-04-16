<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

use App\User;

class UserController extends Controller
{

    /**
     * Show the application dashboard (home).
     *
     * @return Renderable
     */
    public function home()
    {
        return redirect()->route('target.index');
    }

    public function editPersonal()
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        $data = [
            'user' => $user
        ];

        return view('pages.account.personal')->with($data);
    }

    public function updatePersonal(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'email' => 'required|email'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = Auth::user();
            $user->username = $request->username;
            $user->email = $request->email;

            if ($user->save()) {
                DB::commit();
                Toastr::success('Your information has been successfully updated!', 'Success');
                return redirect()->route('target.index');
            }
        } catch (\Exception $error) {
            DB::rollBack();
            Toastr::error('Something went wrong. Please try again!', 'Error');
        }
        return redirect()->route('account.personal.edit');
    }

    public function editPassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data = [
            'user' => $user
        ];

        return view('pages.account.password')->with($data);
    }

    public function updatePassword(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = Auth::user()->id;
            if (Auth::check()) {
                $validator = Validator::make($request->all(), [
                    'current_password' => 'required',
                    'password' => 'required',
                    'password_confirmation' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                } else {
                    if (!Hash::check($request->current_password, Auth::user()->password)) {
                        // The passwords does not match
                        return redirect()->back()->with('error', 'The password you entered does not match your current one. Please try again.');
                    }

                    if (strcmp($request->current_password, $request->password) == 0) {
                        // Current password and new password are same
                        return redirect()->back()->with('error', 'Your new password cannot be as same as your current password. Please use a different password.');
                    }

                    // Change Password
                    $user = User::find($id);
                    $user->password = Hash::make($request->password);
                    $user->save();

                    DB::commit();
                    Toastr::success('Password successfully changed!', 'Success');

                    return redirect()->route('target.index');
                }
            }
        } catch (\Exception $error) {
            DB::rollBack();
            Toastr::error('Something went wrong. Please try again!', 'Error');
            return redirect()->back();
        }
    }

}
