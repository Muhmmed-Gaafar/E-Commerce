<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function createUser($request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }

    public function updateUser($data, $id)
    {
        $user = User::where('id', $id)->first();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return $user;
    }
}

