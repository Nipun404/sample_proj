<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        //validate input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //create user in DB
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->passsword,
        ]);

        //create sanctum token
        $token = $user->createToken('api-token')->plainTextToken;

        //return token
        return response()->json([
            'token' => $token
        ]);


    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required|min:6',
        ]);

        //find user
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid credentials',
            ],401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token
        ]);

        
    }
}
