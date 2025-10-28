<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => true,
                'name' => $request->user()->name,
                'token' => $request->user()->createToken('TOKEN')->plainTextToken
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Credenciales invalidas'
            ]);
        }
    }
}
