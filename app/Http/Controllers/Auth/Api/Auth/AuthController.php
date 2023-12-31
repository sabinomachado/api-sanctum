<?php

namespace App\Http\Controllers\Auth\Api\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        try{

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $token = $request->bearerToken();
                dd($token);
                //return response()->json(['ok' => $e->getMessage()], 500);
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout(){
        try{
            auth()->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out'], 200);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(RegisterRequest $request){
        try{
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 201);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function user(){
        try{
            return response()->json(auth()->user(), 200);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
