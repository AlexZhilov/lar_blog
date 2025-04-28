<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'slug' => ['required', 'string', 'max:255', 'unique:roles,slug', 'regex:/^[a-z0-9\-\_]+$/'],
            'text' => ['string', 'max:255', 'nullable'],
            'permissions' => ['array', 'exists:permissions,id'],
            'users' => ['array', 'exists:users,id'],
        ];
    }
}
