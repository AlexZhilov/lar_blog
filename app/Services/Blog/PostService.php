<?php

namespace App\Services\Blog;

use App\Http\Requests\Admin\Blog\PostRequest;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\UseCases\Files\ImageService;
use DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    private ImageService $images;

    public function __construct(ImageService $images)
    {
        $this->images = $images;
    }

    /**
     * @throws \Throwable
     */
    public function store(PostRequest $request): Post
    {
        return DB::transaction(function () use ($request) {
            $data = collect($request->validated());

            $tags = $data->pull('tag');
            Tag::createNew($tags);

            $post = Post::create($data->toArray());

            if ($data->has('image')) {
                $data->put('image', $this->saveImage($data->pull('image'), $post->id));
            }

            $post->tags()->attach($tags);

            return $post;
        });
    }

    public function update(PostRequest $request, Post $post): Post
    {
        return DB::transaction(function () use ($request, $post) {
            $data = collect($request->validated());
            //tags
            $tags = $data->pull('tag');
            Tag::createNew($tags);
            $post->tags()->sync($tags);
            //image
            if ($data->has('image')) {
                $data->put('image', $this->saveImage($data->pull('image'), $post->id));
            }

            $post->update($data->toArray());

            return $post;
        });
    }

    public function delete(Post $post)
    {
        $post->delete();
    }

    public function removeImage(Post $post)
    {
        Storage::delete(storage_image($post->image));
        Storage::delete(storage_image(ImageService::getPreview($post->image)));
        $post->update(['image' => '']);
    }

    private function saveImage($fileImage, $prefix_id = '')
    {
        return $this->images
            ->file($fileImage)
            ->dir('post/big')
            ->prefix("post{$prefix_id}_")
            ->upload()['big'];
    }


}