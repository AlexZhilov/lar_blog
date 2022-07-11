<?php

namespace App\Http\Requests\Admin\Blog\Category;

use Illuminate\Foundation\Http\FormRequest;
use Str;

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
        $id = $this->category->id ?? '';
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ["unique:blog_categories,slug,{$id}", /*'alpha_dash',*/ 'max:255'],
            'parent_id' => ['required', 'integer', 'exists:blog_categories,id'],
            'description' => ['required', 'min:5'],
        ];
    }

    /**
     * Generate Slug
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug ?
                Str::of($this->slug)->slug()->limit(75) :
                Str::slug(Str::of($this->title)->limit(75))
        ]);
    }

}
