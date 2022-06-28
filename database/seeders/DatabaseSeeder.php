<?php

namespace Database\Seeders;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Models\User;
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
        BlogCategory::factory(20)->create();
        BlogPost::factory(250)->create();
    }
}
