<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profession;

class ProfessionService
{
    public function getAllProfessions()
    {
        return Profession::select('id', 'name')->get();
    }
    
    public function getPaginatedProfessions($perPage = 15)
    {
        return Profession::paginate($perPage);
    }

    public function createProfession(array $data)
    {
        return Profession::create($data);
    }

    public function updateProfession($id, array $data)
    {
        $profession = Profession::findOrFail($id);
        $profession->update($data);
        return $profession;
    }

    public function deleteProfession($id)
    {
        return Profession::destroy($id);
    }

    public function getUsersInProfession($id)
    {
        return User::where('profession_id', $id)->with('village', 'profession')->get()->map(function ($user) {
            return [
                'name' => $user->name,
                'phone' => $user->phone,
                'village' => $user->village->name,
                'profession' => $user->profession->name,
            ];
        });
    }
}
