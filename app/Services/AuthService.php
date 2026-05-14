<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Register a new user
     */
    public function registerUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        // Set default type/role if not provided
        // if (!isset($data['type'])) {
        //     $data['type'] = 'no';
        // }
        // if (!isset($data['role'])) {
        //     $data['role'] = 'user';
        // }
        
        return User::create($data);
    }

    /**
     * Attempt login with credentials
     * Returns true on success, false on failure
     */
    public function attemptLogin(array $credentials)
    {
        return Auth::attempt($credentials);
    }
    
    /**
     * Get user by phone
     */
    public function getUserByPhone($phone)
    {
        return User::where('phone', $phone)->first();
    }
}
