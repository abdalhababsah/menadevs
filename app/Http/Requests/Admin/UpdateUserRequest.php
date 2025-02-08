<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Adjust authorization as needed.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        // Use route-model binding to get the user's ID.
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $userId,
            'role_id'    => 'required|exists:roles,id',
            // Password is optional; if provided, must be at least 6 characters.
            'password'   => 'nullable|min:6',
        ];
    }
}