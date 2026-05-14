<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Fix usage of Request facade

class UserController extends Controller
{
    public $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getPaginatedUsers(15);

        return response()->json([
            'message' => 'Users retrieved successfully',
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'type' => $user->type,
                    'role' => $user->role,
                    'village' => $user->village?->name,
                    'profession' => $user->profession?->name,
                ];
            }),
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
            ],
        ], 200);
    }

    public function search($keyword)
    {
        $users = $this->userService->searchUsers($keyword);

        return response()->json([
            'message' => 'search completed successfully',
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'village' => $user->village?->name,
                    'profession' => $user->profession?->name,
                ];
            }),
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'type' => 'required|in:true,false',
            'role' => 'required|in:user,admin',
            'password' => 'required|string|min:8|confirmed',
            'village_id' => 'required|exists:villages,id',
            'profession_id' => 'required|exists:professions,id',
        ]);

        $user = $this->userService->createUser($validated);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function profile()
    {
        $user = User::with('village', 'profession')->find(Auth::id());

        return response()->json([
            'message' => 'Current user profile retrieved successfully',
            'profile' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'type' => $user->type,
                'role' => $user->role,
                'village_id' => $user->village_id,
                'profession_id' => $user->profession_id,
                'village' => $user->village?->name,
                'profession' => $user->profession?->name,
            ],
        ], 200);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'message' => 'User retrieved successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'type' => $user->type,
                'role' => $user->role,
                'village_id' => $user->village_id,
                'profession_id' => $user->profession_id,
                'village' => $user->village?->name,
                'profession' => $user->profession?->name,
            ],
        ], 200);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $this->userService->updateProfile(Auth::id(), $request->validated());

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

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone,' . $id,
            'type' => 'required|in:true,false',
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:8|confirmed',
            'village_id' => 'required|exists:villages,id',
            'profession_id' => 'required|exists:professions,id',
        ]);

        $user = $this->userService->updateProfile($id, $validated);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => [
                'name' => $user->name,
                'phone' => $user->phone,
                'role' => $user->role,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return response()->json([
            'message' => 'deleted successfully',
        ]);
    }
}
