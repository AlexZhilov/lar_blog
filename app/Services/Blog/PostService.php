<?php


namespace App\Services\Blog;


use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\UseCases\Files\ImageService;
use DB;

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
        return DB::transaction(function () use ($data){

            $tags = $data->pull('tag');
            Tag::createNew( $tags );

            if( $data->get('image') ){
                $data->put('image', $this->saveImage( $data->pull('image') ));
            }

            $post = Post::create( $data->toArray() );
            $post->tags()->attach( $tags );

            return $post;
        });
    }

    /**
     * @param $data
     * @param Post $post
     */
    public function update($data, Post $post)
    {

        DB::transaction(function () use ($data, $post){
            //tags
            $tags = $data->pull('tag');
            Tag::createNew( $tags );
            $post->tags()->sync( $tags );
            //image
            if( $data->get('image') ){
                $data->put('image', $this->saveImage( $data->pull('image') ));
            }

            $post->update( $data->toArray() );

    //        dd($data);
        });

    }

    /**
     * @param Post $post
     */
    public function delete(Post $post)
    {
        $post->delete();
    }


    private function saveImage($fileImage)
    {
        return $this->image
                ->file( $fileImage )
                ->dir('post/big')
                ->prefix('post_')
                ->upload()['big'];
    }

}