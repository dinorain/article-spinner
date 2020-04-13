<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\SpintaxInput;

class TargetController extends Controller
{
    public function detail($id)
    {
        $spintaxInput = SpintaxInput::find($id);
        if (!$spintaxInput) {
            return response()->json(['error' => "Not found."], 404);
        }
        return response()->json($spintaxInput, 200);
    }
}
