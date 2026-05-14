<?php

namespace App\Services;

use App\Models\User;
use App\Models\Village;

class VillageService
{
    public function getAllVillages()
    {
        return Village::select('id', 'name')->get();
    }

    public function getPaginatedVillages($perPage = 15)
    {
        return Village::paginate($perPage);
    }

    public function createVillage(array $data)
    {
        return Village::create($data);
    }

    public function updateVillage($id, array $data)
    {
        $village = Village::findOrFail($id);
        $village->update($data);
        return $village;
    }

    public function deleteVillage($id)
    {
        return Village::destroy($id);
    }

    public function getUsersInVillage($id)
    {
        return User::where('village_id', $id)->with('village', 'profession')->get()->map(function ($user) {
            return [
                'name' => $user->name,
                'phone' => $user->phone,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ];
        });
    }
}
