<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $title = $this->faker->sentence(random_int(1,3));
        $description = $this->faker->realText;

        return [
            'category_id' => Category::count() > 0 ? Category::get()->random() : 1,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => Str::limit($description, 300),
            'description' => $description,
            'status' => random_int(1,10) > 1,
            'price' => $this->faker->numberBetween(100, 1000),
            'views' => $this->faker->numberBetween(1, 1000),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
