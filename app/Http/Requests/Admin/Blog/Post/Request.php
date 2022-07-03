<?php

namespace App\Http\Requests\Admin\Blog\Post;

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
//        $id = $this->category->id ?? '';
        return [
            'title' => ['required','string','max:255'],
            'slug' => ["unique:blog_categories,slug",'alpha_dash','max:255'],
            'category_id' => ['required','integer','exists:blog_categories'],
            'excerpt' => ['required','min:5'],
            'content_raw' => ['required','min:5'],
        ];
    }
}
