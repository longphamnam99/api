<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ApiNewsController extends Controller
{
    public function add_category(Request $request) 
    {
        return response()->json($request);
    }
}
