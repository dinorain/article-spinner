<?php

namespace App\Http\Controllers;

use App\Model\SpintaxInput;
use App\Model\SpintaxOutput;

class AdminController extends Controller
{
    public function index()
    {
        $inputs = SpintaxInput::all();

        $outputs = SpintaxOutput::orderBy('spintax', 'ASC')->get();
        $spintaxCollections = [];
        foreach ($outputs as $o) $spintaxCollections[$o->target_id] = '';
        foreach ($outputs as $o)
            $spintaxCollections[$o->target_id] =
                $spintaxCollections[$o->target_id] === '' ?
                    $spintaxCollections[$o->target_id].$o->spintax : $spintaxCollections[$o->target_id].'|'.$o->spintax;

        $data = [
            'inputs' => $inputs,
            'spintaxCollections' => $spintaxCollections
        ];

        return view('pages.admin.index')->with($data);
    }
}
