<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home() {
        $title = 'Welcome to Laravel';
        //return view('pages.index', compact('title'));
        return view('pages.home')->with('title', $title); // passing single variable

    }

    public function contact() {
        $title = 'Contact us';
        //return view('pages.index', compact('title'));
        return view('pages.contact')->with('title', $title); // passing single variable

    }

    public function services() {
        $data = array(
            'title' => 'Services',
            'services' => ['Web', 'Mobile', 'SEO']

        );
        return view('pages.services')->with($data); // passing multi variables
    }
}
