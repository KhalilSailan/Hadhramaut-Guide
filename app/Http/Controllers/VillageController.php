<?php

namespace App\Http\Controllers;

use App\Services\VillageService;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    protected $villageService;

    public function __construct(VillageService $villageService)
    {
        $this->villageService = $villageService;
    }

    public function index()
    {
        $villages = $this->villageService->getAllVillages();
        return response()->json([
            'message' => 'successfully',
            'villages' => $villages,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $village = $this->villageService->createVillage($validated);

        return response()->json([
            'message' => 'Village created successfully',
            'village' => $village,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $village = $this->villageService->updateVillage($id, $validated);

        return response()->json([
            'message' => 'Village updated successfully',
            'village' => $village,
        ], 200);
    }

    public function destroy($id)
    {
        $this->villageService->deleteVillage($id);

        return response()->json([
            'message' => 'Village deleted successfully',
        ], 200);
    }

    public function users_in_village($id)
    {
        $users = $this->villageService->getUsersInVillage($id);
        return response()->json([
            'message' => 'Users in village retrieved successfully',
            'users' => $users,
        ], 200);
    }
}
