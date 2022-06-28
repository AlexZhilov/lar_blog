<?php

namespace Database\Factories\Blog;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(random_int(1,3));
        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'description' => $this->faker->realText,
        ];
    }
}
