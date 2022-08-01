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
        $post = Post::create( $data->except('tag')->toArray() );
        $post->tags()->attach( $data->get('tag') );
        return $post;
    }

    /**
     * @param $data
     * @param Post $post
     */
    public function update($data, Post $post)
    {
        $post->update( $data->except('tag')->toArray() );
        $post->tags()->sync( $data->get('tag') );
    }

    /**
     * @param Post $post
     */
    public function delete(Post $post)
    {
        $post->delete();
    }
}