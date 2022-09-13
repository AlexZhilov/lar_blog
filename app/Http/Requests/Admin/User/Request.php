<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->user->id ?? '';
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,$id", 'max:255'],
            'password' => ['string', 'nullable'],
            'active' => ['boolean'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'roles' => ['array', 'nullable'],
        ];
    }
}
