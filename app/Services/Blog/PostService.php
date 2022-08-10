<?php


namespace App\Services\Blog;


use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\UseCases\Files\ImageService;

class PostService
{
    private $image;

    public function __construct(ImageService $image)
    {
        $this->image = $image;
    }

    /**
     * @param $data
     * @return Post
     */
    public function store($data)
    {
        $tags = $data->get('tag');
        $post = Post::create( $data->except('tag')->toArray() );
        Tag::createNew( $tags );
        $post->tags()->attach( $tags );
        return $post;
    }

    /**
     * @param $data
     * @param Post $post
     */
    public function update($data, Post $post)
    {
        $tags = $data->get('tag');
        $image = $this->image
                    ->file( $data->get('image') )
                    ->dir('post/main/big')
                    ->upload();
        dd($image);

        $post->update( $data->except('tag')->toArray() );
        Tag::createNew( $tags );
        $post->tags()->sync( $tags );
    }

    /**
     * @param Post $post
     */
    public function delete(Post $post)
    {
        $post->delete();
    }


    public function saveImage($fileImage)
    {
        $fileImage->store('images/post/main/big');
    }

}