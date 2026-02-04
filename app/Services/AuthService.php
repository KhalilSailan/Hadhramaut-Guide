<?php

namespace App\services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function registerUsers($request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'type' => $request->type,
            'village_id' => $request->village_id,
            'profession_id' => $request->profession_id,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

    public function loginUser($request)
    {
        if (!Auth::attempt($request('phone', 'password'))) {
            return response()->json([
                'message' => 'Phone or password is incorrect',
            ], 401);
        }
        $user = User::where('phone', $request->phone)->first();
        return $user;
    }
}
