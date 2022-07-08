<?php


namespace App\Services\Blog;


use App\Models\Blog\Post;
use Carbon\Carbon;

class PostService
{
    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        $post = (new Post)->create($data);
        flash("Пост '{$post->title}' создан.")->success();

        return $post;
    }

    public function update($data, Post $post)
    {
        if($data['is_published'] && empty($post->published_at)){
            $data['published_at'] = Carbon::now();
        }

        $post->update($data);
        flash("Пост '{$post->title}' обновлен.")->success();
    }

    public function delete(Post $post)
    {
        $post->delete();
        flash("Пост '{$post->title}' удален.");
    }
}