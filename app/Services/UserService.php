<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getAllUsers()
    {
        return User::with('village', 'profession')
            ->select('id', 'name', 'email', 'phone', 'village_id', 'profession_id', 'role')
            ->get();
    }
    
    public function getPaginatedUsers($perPage = 15)
    {
        return User::with('village', 'profession')->paginate($perPage);
    }

    public function searchUsers($keyword, $perPage = 15)
    {
        return User::with('village', 'profession')
            ->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('phone', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->paginate($perPage);
    }

    public function filterUsers(array $filters = [], $perPage = 15)
    {
        $query = User::with('village', 'profession');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['village_id'])) {
            $query->where('village_id', $filters['village_id']);
        }

        if (!empty($filters['profession_id'])) {
            $query->where('profession_id', $filters['profession_id']);
        }

        return $query->latest()->paginate($perPage);
    }

    public function getUserById($id)
    {
        return User::with('village', 'profession')->find($id);
    }
    
    public function createUser(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return User::create($data);
    }

    public function updateProfile($id, array $data)
    {
        $user = User::findOrFail($id);

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // don't update password if empty
        }
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }
}
