<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'Required|string',
            'phone' => 'Required|max:9|unique:users,phone',
            'type' => 'required|in:true,false',
            'village_id' => 'required|exists:villages,id',
            'profession_id' => 'required|exists:professions,id',
            'password' => 'required|min:6',
        ];
    }
}
