<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TargetController extends Controller
{
    public function detail($id)
    {
        return response()->json(null, 200);
    }
}
