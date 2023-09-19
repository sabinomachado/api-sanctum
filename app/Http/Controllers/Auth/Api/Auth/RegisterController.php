<?php

namespace App\Http\Controllers\Auth\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request, User $user){
        //TO-DO: validate request
        $userData = $request->only(['name', 'email', 'password']);
        if(!$user = $user->create($userData)){
            return response()->json(['message' => 'User not created'], 500);
        }
        $user->token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'User created successfully',
            'data' => ['user' => $user],
        ], 201);
    }
}
