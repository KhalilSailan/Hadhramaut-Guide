<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService ;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $this->authService->registerUser($request->validated());
        return response()->json([
            'user' => $user,
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        if (!$this->authService->attemptLogin($request->only('phone' , 'password'))){
            return response()->json([
                'message' => 'Phone or password is incorrect'
            ], 401);
        }

        $user = $this->authService->getUserByPhone($request->phone);
        $token = $user->createToken('user-token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=> 'logout successfully'
        ]);
    }
}
