<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Str;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $id = $this->admin_post->id ?? '';
        return [
            'title' => ['required','string','max:255'],
            'slug' => ["unique:blog_posts,slug,{$id}",/*'alpha_dash',*/'max:255'],
            'user_id' => ['required','integer','exists:users,id'],
            'category_id' => ['required','integer','exists:blog_categories,id'],
            'excerpt' => ['required','min:5'],
            'content' => ['required','min:5'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'status' => 'boolean',
            'views' => ['integer'],
            'tag' => ['array','nullable'],
        ];
    }

    /**
     * Generate Slug
     */
    protected function prepareForValidation() :void
    {
        $this->merge([
            'user_id' => $this->user_id ?? 1,
            'slug' => $this->slug ?
                Str::of($this->slug)->slug()->limit() :
                Str::slug( Str::of($this->title)->limit() )
        ]);
    }

}
