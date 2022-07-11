<?php

namespace App\Providers;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Observers\Blog\CategoryObserver;
use App\Observers\Blog\PostObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Post::observe(PostObserver::class );
        Category::observe( CategoryObserver::class );
    }
}
