<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DawuhController extends Controller
{
    public function open()
    {
        $data = "Public data, anyone can access it";
        return response()->json(compact('data'), 200);
    }

    public function closed()
    {
        $data = "Only authorized users can see this";
        return response()->json(compact('data'), 200);
    }
}
