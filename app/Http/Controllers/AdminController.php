<?php

namespace App\Http\Controllers;

use App\Model\SpintaxInput;
use App\Model\SpintaxOutput;

class AdminController extends Controller
{
    public function index()
    {
        $inputs = SpintaxInput::all();

        $spintaxCollections = SpintaxOutput::orderBy('spintax', 'ASC')->get();
        $spintaxTargetIdDict = [];
        foreach ($spintaxCollections as $sc) $spintaxTargetIdDict[$sc->target_id] = '';
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
}
