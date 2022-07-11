<?php


namespace App\Services\Blog;


use App\Models\Blog\Post;

class PostService
{
    /**
     * @param $data
     * @return Post
     */
    public function store($data)
    {
        return (new Post)->create($data);
    }

    /**
     * @param $data
     * @param Post $post
     */
    public function update($data, Post $post)
    {
        $post->update($data);
    }

    /**
     * @param Post $post
     */
    public function delete(Post $post)
    {
        $post->delete();
    }
}