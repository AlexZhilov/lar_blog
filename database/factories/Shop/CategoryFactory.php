<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'parent_id' => Category::count() >= 5 ? random_int(1,5) : null,
            'title' => $title = $this->faker->unique()->sentence(random_int(1,3)),
            'slug' => Str::slug($title),
            'description' => $this->faker->realText,
        ];
    }
}
