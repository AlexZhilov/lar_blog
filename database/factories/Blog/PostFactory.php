<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(random_int(1,5));
        $content = $this->faker->realText();
        $is_published = random_int(1,10) > 1;
        $created_at = $this->faker->dateTimeBetween('-5 weeks', '-1 weeks');

        return [
            'category_id' => Category::get()->random()->id,
            'user_id' => User::get()->random()->id,
            'slug' => Str::slug($title),
            'title' => $title,
            'excerpt' => Str::limit($content, 255),
            'content_raw' => $content,
            'content_html' => $content,
            'is_published' => $is_published,
            'published_at' => $is_published ? $this->faker->dateTimeBetween('-2 weeks', '-1 days') : null,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
