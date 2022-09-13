<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPosts();
    }


    private function createPosts()
    {
        Category::factory(5)->create();
        Category::factory(20)->create();
        Tag::factory(25)->create();

        foreach (Post::factory(255)->create() as $post) {
            $post->tags()->attach(Tag::get()->random()->id);
        }

    }
}
