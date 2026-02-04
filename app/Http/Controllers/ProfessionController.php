<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function index()
    {
        $profession = Profession::select('id','name')->get();
        return response()->json([
            'message' => 'successfully',
            'village' => $profession
        ]);
    }

    public function users_in_profession($id)
    {
        $profession = User::where('profession_id', $id)->get()->map(function ($user) {
            return [
                'name' => $user->name,
                'phone' => $user->phone,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ];
        });
        return response()->json([
            'message' => 'successfully',
            'village' => $profession
        ]);
    }
}
