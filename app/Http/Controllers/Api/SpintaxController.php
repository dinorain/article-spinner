<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\SpintaxOutput;

class SpintaxController extends Controller
{
    public function detail($target_id, $id)
    {
        $spintaxOutput = SpintaxOutput::find($id);
        if (!$spintaxOutput) {
            return response()->json(['error' => "Not found."], 404);
        }
        return response()->json($spintaxOutput, 200);
    }
}
