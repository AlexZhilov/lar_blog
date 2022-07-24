<?php

namespace App\Observers\Blog;

use App\Models\Blog\Post;
use Carbon\Carbon;

class PostObserver
{


    /**
     * Before create new post
     *
     * @param Post $post
     */
    public function creating(Post $post)
    {
    }

    /**
     * Before update post
     *
     * @param Post $post
     */
    public function updating(Post $post)
    {
        if ($post->is_published && empty($post->published_at)) {
            $post->published_at = Carbon::now();
        }
    }

    public function deleting(Post $post)
    {
//        dd($post);
    }

    /**
     * Handle the Post "created" event.
     *
     * @param Post $post
     * @return void
     */
    public function created(Post $post)
    {
        flash("Пост '{$post->title}' создан.")->success();

    }

    /**
     * Handle the Post "updated" event.
     *
     * @param Post $post
     * @return void
     */
    public function updated(Post $post)
    {
        flash("Пост '{$post->title}' обновлен.")->success();
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param Post $post
     * @return void
     */
    public function deleted(Post $post)
    {
        flash("Пост '{$post->title}' удален.");
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param Post $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param Post $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
