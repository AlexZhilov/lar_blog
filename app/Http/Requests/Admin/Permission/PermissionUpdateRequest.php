<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $this->permission->id],
            'slug' => ['required', 'string', 'max:255', 'unique:permissions,slug,' . $this->permission->id, 'regex:/^[a-z0-9\-\_]+$/'],
            'text' => ['string', 'max:255', 'nullable'],
            'roles' => ['array', 'exists:roles,id'],
            'users' => ['array', 'exists:users,id'],
        ];
    }
}
