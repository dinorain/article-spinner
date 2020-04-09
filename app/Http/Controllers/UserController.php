<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Show the application dashboard (home).
     *
     * @return Renderable
     */
    public function home()
    {

        return view('pages.home');
    }

    public function editPersonal()
    {

        return view('pages.account.personal');
    }

    public function updatePersonal(Request $request)
    {
        return redirect()->route('account.personal.edit');
    }

    public function editPassword()
    {
        return view('pages.account.password');
    }

    public function updatePassword(Request $request)
    {
        return redirect('/');
    }

}
