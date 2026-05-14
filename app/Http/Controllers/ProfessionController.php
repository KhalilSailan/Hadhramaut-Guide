<?php

namespace App\Http\Controllers;

use App\Services\ProfessionService;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    protected $professionService;

    public function __construct(ProfessionService $professionService)
    {
        $this->professionService = $professionService;
    }

    public function index()
    {
        $professions = $this->professionService->getAllProfessions();
        return response()->json([
            'message' => 'successfully',
            'professions' => $professions,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $profession = $this->professionService->createProfession($validated);

        return response()->json([
            'message' => 'Profession created successfully',
            'profession' => $profession,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $profession = $this->professionService->updateProfession($id, $validated);

        return response()->json([
            'message' => 'Profession updated successfully',
            'profession' => $profession,
        ], 200);
    }

    public function destroy($id)
    {
        $this->professionService->deleteProfession($id);

        return response()->json([
            'message' => 'Profession deleted successfully',
        ], 200);
    }

    public function users_in_profession($id)
    {
        $users = $this->professionService->getUsersInProfession($id);
        return response()->json([
            'message' => 'Users in profession retrieved successfully',
            'users' => $users,
        ], 200);
    }
}
