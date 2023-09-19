<?php

namespace App\Http\Controllers\Auth\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //TO-DO: validate request
        $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = auth()->user()->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], status: 200);
    }
}
