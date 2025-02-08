<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get filtered users with pagination.
     */
    public function getFilteredUsers(Request $request)
    {
        $query = User::query()->with('role');

        // Apply filters
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'LIKE', '%' . $request->name . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $request->name . '%');
            });
        }

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('role')) {
            $query->where('role_id', $request->role);
        }

        return $query->paginate(10)->withQueryString(); // Preserve query string for pagination
    }

    /**
     * Create a new user.
     */
    public function createUser(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role_id'    => $data['role_id'],
        ]);
    }

    /**
     * Update an existing user.
     */
    public function updateUser(User $user, array $data)
    {
        $updateData = [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'role_id'    => $data['role_id'],
        ];

        // Update password only if provided
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        $user->delete();
    }
}