<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
           if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'message' => 'your email or password is wrong'
                ], 401);
           }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'could not create token'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ],
            'message' => 'login success'
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:12',
            'name' => 'required|min:4|max:32|unique:users'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $request->name,
                'email' => $request->email,
                'token' => $token,
            ],
            'message' => "registration success"
        ]);
    }

    public function refresh(Request $request)
    {
       return response()->json(auth()->refresh());
    }

    public function me(Request $request)
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
