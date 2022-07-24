<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'title' => $title = $this->faker->unique()->sentence(random_int(1,3)),
            'slug' => Str::slug($title),
            'description' => $this->faker->realText,
        ];
    }
}
