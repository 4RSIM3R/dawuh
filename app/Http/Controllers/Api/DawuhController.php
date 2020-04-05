<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dawuh;

class DawuhController extends Controller
{
    public function index()
    {
        # TODO : Get All Data Of Dawuh
        if (Dawuh::get()->count() > 0) {
            $dawuh = Dawuh::all();
            return response()->json([
                'success' => true,
                'data' => $dawuh,
                'message' => 'get dawuh data success'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'dawuh is empty'
            ]);
        }
    }

    public function detail($id)
    {
        # TODO : Get Detail Of Dawuh
        $dawuh = Dawuh::where('id', '=', $id)->get();
        if ($dawuh->count() > 0) {
            return response()->json([
                'success' => true,
                'data' => $dawuh,
                'message' => 'get dawuh data success'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'could not found dawuh'
            ]);
        }
    }

    public function add(Request $request)
    {
        # TODO : Add Dawuh Here
        $this->validate($request, [
            'dawuh' => 'required|unique:dawuhs',
            'author' => 'required',
            'user_id' => 'required'
        ]);
        Dawuh::create([
            'dawuh' => $request->dawuh,
            'author' => $request->author,
            'user_id' => $request->user_id
        ]);
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'insert dawuh success'
        ]);
    }

    public function update($id, Request $request)
    {
        # TODO : Update Dawuh Here
        $this->validate($request, [
            'dawuh' => 'required',
            'author' => 'required',
            'user_id' => 'required'
        ]);
        $dawuh = Dawuh::find($id);
        $dawuh->dawuh = $request->dawuh;
        $dawuh->author = $request->author;
        $dawuh->user_id = $request->user_id;
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'update dawuh success'
        ]);
    }

    public function delete($id)
    {
        # TODO : Delete Dawuh Here
        Dawuh::where('id',$id)->delete();
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'delete dawuh success'
        ]);
    }
}
