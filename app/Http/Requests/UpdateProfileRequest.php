<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . Auth::id(),
            'phone' => 'sometimes|max:9|min:9|unique:users,phone,' . Auth::id(),
            'role' => 'sometimes|in:admin,user',
            'type' => 'sometimes|in:true,false',
            'village_id' => 'sometimes|exists:villages,id',
            'profession_id' => 'sometimes|exists:professions,id',
            'password' => 'sometimes|min:6',
        ];
    }
}
