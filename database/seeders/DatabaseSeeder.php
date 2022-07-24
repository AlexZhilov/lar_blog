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
        $this->createUsers();
        $this->createPosts();
    }


    private function createPosts()
    {
        Category::factory(20)->create();
        $posts = Post::factory(255)->create();
        $tags = Tag::factory(5)->create();

        foreach ($posts as $post) {
//            $tagId = $tags->random(random_int(1, 5))->pluck('id');
            $post->tags()->attach( Tag::get()->random()->id );
        }

    }


    private function createUsers()
    {
        User::factory()->create(UserFactory::createAdmin());
        User::factory(20)->create();
    }
}
