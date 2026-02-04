<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        return response()->json([
            'message' => ' successful',
            'users' => $this->userService->getAllUsers(),
        ], 200);
    }


    public function search($keyword)
    {
        $user = $this->userService->searchUsers($keyword);
        if (!$user) {
            return response()->json([
                'message' => 'search successfully',
                'user' => 'not found'
            ], 404);
        }
        return response()->json([
            'message' => 'search successfully',
            'user ' => [
                'name' => $user->name,
                'phone' => $user->phone,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ]
        ], 200);
    }


    public function profile()
    {
        $user = Auth::user();
        return response()->json([
            'message' => 'information the currently user',
            'profile' => [
                'name' => $user->name,
                'phone' => $user->phone,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ],
        ]);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return response()->json([
                'message' => 'successfully',
                'user' => 'not found'
            ], 404);
        }
        return response()->json([
            'message' => 'successfully',
            'user' => [
                'name' => $user->name,
                'phone' => $user->phone,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ]
        ], 200);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $this->userService->updateProfile($request->validated());

        return response()->json([
            'message' => 'profile updated successfully',
            'user' => [
                'name' => $user->name,
                'phone' => $user->phone,
                'whatsapp' => $user->phone,
                'role' => $user->role,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ]
        ]);
    }


    public function destroy($id)
    {
        $user = $this->userService->deleteUser($id);
        return response()->json([
            'message' => 'deleted successfully',
            'user' => $user
        ]);
    }
}
