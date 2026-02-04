<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'type' => $request->type,
            'role' => $request->role,
            'village_id' => $request->village_id,
            'profession_id' => $request->profession_id,
            'password' => Hash::make($request->password),
        ]); 
        return response()->json([
            'user' => $user,
        ]);
    }

    public function login(LoginUserRequest $request)
    {

        if (!Auth::attempt($request->only('phone', 'password'))) {

            return response()->json([
                'message' => 'Phone or password is incorrect'
            ], 401);
        }

        $user = User::where('phone', $request->phone)->first();
        $token = $user->createToken('user-token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }
    
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=> 'logout successfully'
        ]);
    }

}
