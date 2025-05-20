<?php

namespace App\RouteBindings;

use App\Models\Blog\Post;
use Illuminate\Support\Facades\Route;

class BlogBinding
{

    public static function register(): void
    {
        Route::bind('post', function ($slug) {
            return Post::slug($slug)->published()->firstOrFail();
        });

        Route::bind('admin_post', function ($value) {
            return Post::findOrFail($value);
        });

    }
}