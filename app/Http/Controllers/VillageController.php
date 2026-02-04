<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function index()
    {
        $villages = Village::select('id','name')->get();
        return response()->json([
            'message' => 'successfully',
            'village' => $villages
        ]);
    }

    public function users_in_village($id)
    {
        $villages = User::where('village_id', $id)->get()->map(function ($user) {
            return [
                'name' => $user->name,
                'phone' => $user->phone,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ];
        });
        return response()->json([
            'message' => 'successfully',
            'village' => $villages
        ]);
    }
}
