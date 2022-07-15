<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::get()->random()->id,
            'tag_id' => Tag::get()->random()->id
        ];
    }
}
