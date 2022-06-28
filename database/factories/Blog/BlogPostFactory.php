<?php

namespace Database\Factories\Blog;

use App\Models\Blog\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
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
        return [
            'category_id' => BlogCategory::get()->random()->id,
            'user_id' => User::get()->random()->id,
            'slug' => Str::slug($title),
            'title' => $title,
            'excerpt' => $this->faker->text,
            'content_raw' => $this->faker->text,
            'content_html' => $this->faker->randomHtml(),
            'is_published' => true

        ];
    }
}
