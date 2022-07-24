<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Models\User;
use Database\Factories\Blog\CategoryFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $this->createUsers();
        $this->createPosts();
    }


    private function createPosts()
    {
        Category::factory(5)->create();
        Category::factory(20)->create();
        Tag::factory(25)->create();

        foreach (Post::factory(255)->create() as $post) {
            $post->tags()->attach( Tag::get()->random()->id );
        }

    }


    private function createUsers()
    {
        User::factory()->create(UserFactory::createAdmin());
        User::factory(20)->create();
    }
}
