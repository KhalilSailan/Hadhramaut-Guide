<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class DirectoryApiController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search'),
            'village_id' => $request->query('village_id'),
            'profession_id' => $request->query('profession_id'),
        ];

        $users = $this->userService->filterUsers($filters, 15);

        return response()->json([
            'message' => 'Directory retrieved successfully',
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'type' => $user->type,
                    'village_id' => $user->village_id,
                    'profession_id' => $user->profession_id,
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

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'message' => 'User details retrieved successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'type' => $user->type,
                'village_id' => $user->village_id,
                'profession_id' => $user->profession_id,
                'village' => $user->village?->name,
                'profession' => $user->profession?->name,
            ]
        ], 200);
    }
}
