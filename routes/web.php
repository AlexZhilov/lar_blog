<?php

use App\Models\Blog\Tag;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\Blog\DefaultController as BlogDefaultController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/****** SITE ******/
Route::group(['namespace' => 'Site'], function () {

    Route::get('/', 'DefaultController@index')->name('home');

    /* BLOG */
    Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
        Route::get('/', [BlogDefaultController::class, 'index'])->name('blog');
        Route::get('tag/{tag:slug}', [BlogDefaultController::class, 'tag'])->name('blog.tag');
        Route::get('{category:slug}', [BlogDefaultController::class, 'category'])->name('blog.category');
        Route::get('{category:slug}/{post:slug}', [BlogDefaultController::class, 'post'])->name('blog.post');
    });

    /* SHOP */
    Route::group(['namespace' => 'Shop', 'prefix' => 'shop'], static function () {
        Route::get('/', 'DefaultController@index')->name('shop');
        Route::get('{category}', 'DefaultController@category')->name('shop.category');
        Route::get('{category}/{product}', 'DefaultController@product')->name('shop.product');
    });

    /* USER */
    Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => 'auth'], function () {
        Route::get('/', 'DefaultController@index')->name('user.index');

        /* POSTS */
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', 'DefaultController@post')->name('user.blog.post');
            Route::get('comment', 'DefaultController@comment')->name('user.blog.comment');
            Route::get('like', 'DefaultController@like')->name('user.blog.like');
            Route::delete('unlike/{post}', 'DefaultController@unlike')->name('user.blog.unlike');
        });

    });

});


/****** ADMIN ******/
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth.admin', 'verified', 'permission:admin-access']
], static function () {

    Route::get('/', 'DefaultController@index')->name('index');
    ## BLOG ##
    Route::group([
        'namespace' => 'Blog',
        'prefix' => 'blog',
        'as' => 'blog.'
    ], static function () {
        ## CATEGORY ##
        Route::resource('category', 'CategoryController')->except(['show']);
        ## POST ##
        Route::resource('post', 'PostController')->except('show');
        Route::post('post/delete-image', 'PostController@ajaxDeleteImage')->name('post.delete-image');
    });

    /* USERS */
    Route::group(['namespace' => 'User', /*'prefix' => 'user'*//*, 'as' => 'admin.user.'*/], static function () {
        Route::resource('user', 'UserController')->except(['show']);
        Route::post('user/delete-image', 'UserController@ajaxDeleteImage')->name('user.delete-image'); //delete-avatar
        Route::post('user/auth-user', 'UserController@ajaxAuth')->name('user.auth-user'); //auth user

        ## ROLES ##
        Route::resource('roles', 'RoleController')->except(['show']);
        ## PERMISSIONS ##
        Route::resource('permissions', 'PermissionController')->except(['show']);
    });


});


Auth::routes(['verify' => true]);


