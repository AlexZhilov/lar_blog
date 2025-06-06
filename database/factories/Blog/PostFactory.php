<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Category;
use App\Models\User\User;
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
        $title = $this->faker->unique()->realText(50);
        $content = $this->faker->realText(2000);
        $is_published = random_int(1,10) > 1;
        $created_at = $this->faker->dateTimeBetween('-5 weeks', '-1 weeks');

        return [
            'category_id' => Category::count() > 0 ? Category::get()->random() : 1,
            'user_id' => User::get()->random(),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => Str::limit($content, 255),
            'content' => $content,
            'status' => $is_published,
            'published_at' => $is_published ? $this->faker->dateTimeBetween('-2 weeks', '+2 weeks') : null,
            'views' => random_int(1, 1000),
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
