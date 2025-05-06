<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email"],
            'password' => ['string', 'required', 'min:6'],
            'active' => ['boolean'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'roles' => ['array', 'required', 'exists:roles,id'],
            'permissions' => ['array', 'nullable', 'exists:permissions,id'],
        ];
    }
}
