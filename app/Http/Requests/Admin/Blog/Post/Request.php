<?php

namespace App\Http\Requests\Admin\Blog\Post;

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
        $id = $this->post->id ?? '';
        return [
            'title' => ['required','string','max:255'],
            'slug' => ["unique:blog_posts,slug,{$id}",/*'alpha_dash',*/'max:255'],
            'category_id' => ['required','integer','exists:blog_categories,id'],
            'excerpt' => ['required','min:5'],
            'content' => ['required','min:5'],
            'is_published' => 'boolean',
        ];
    }

    /**
     * Generate Slug
     */
    protected function prepareForValidation() :void
    {
        $this->merge([
            'slug' => $this->slug ?
                Str::of($this->slug)->slug()->limit() :
                Str::slug( Str::of($this->title)->limit() )
        ]);
    }

}
