<?php

namespace App\services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getAllUsers()
    {
        return User::with('village', 'profession')
            ->select('name', 'phone', 'village_id', 'profession_id')
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'village_id' => $user->village->name,
                    'profession_id' => $user->profession->name,
                ];
            });
    }

    public function searchUsers($keyword)
    {
        return
            User::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('phone', 'like',  $keyword . '%')
            ->with('village', 'profession')->first();

    }


    public function getUserById($id)
    {
        return
            User::with('village', 'profession')->find($id);
    }

    public function updateProfile(array $data)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        return User::where('id', $id)->delete();
    }
}
