<?php

namespace App\Providers;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\User\User;
use App\Observers\Blog\CategoryObserver;
use App\Observers\Blog\PostObserver;
use App\Observers\User\UserObserver;
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

        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);
        Category::observe(CategoryObserver::class);

    }
}
