<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Models\User;
use Database\Factories\Blog\TagFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(UserFactory::createAdmin());
        User::factory(20)->create();
        Category::factory(20)->create();
        Post::factory(255)->create();
//        Tag::factory(5)->create();
//        TagFactory::factoryForModel()
    }
}
