<?php


namespace App\Services\Blog;


use App\Models\Blog\BlogPost;

class PostService
{
    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        $post = (new BlogPost)->create($data);
        flash("Пост '{$post->title}' создан.")->success();

        return $post;
    }

    public function update($data, BlogPost $post)
    {
        $post->update($data);
        flash("Пост '{$post->title}' обновлен.")->success();
    }

    public function delete(BlogPost $post)
    {
        $post->delete();
        flash("Пост '{$post->title}' удален.");
    }
}