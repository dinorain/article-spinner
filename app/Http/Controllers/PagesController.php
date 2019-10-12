<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome to Laravel';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title); // passing single variable

    }

    public function services() {
        $data = array(
            'title' => 'Services',
            'services' => ['Web', 'Mobile']

        );
        return view('pages.services')->with($data); // passing multi variables
    }
}
