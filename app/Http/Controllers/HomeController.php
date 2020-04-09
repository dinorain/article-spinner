<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function welcome()
    {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     if ($user->role_code === 'admin') {
        //         return redirect()->route('admin.index');
        //     } else if ($user->role_code !== 'admin') {
        //         return redirect()->route('home');
        //     }
        // }

        return view('pages.welcome');
    }

}
