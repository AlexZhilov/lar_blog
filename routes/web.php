<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['namespace' => 'Site'], function (){

    Route::get('/', 'SiteController@index')->name('home');

    /* BLOG */
    Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function (){
        Route::get('/', 'MainController@index');
    });

    /* USER */
    Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => 'auth'], function (){
       Route::get('/', 'MainController@index')->name('user.index');

       /* POSTS */
       Route::group(['prefix' => 'post'], function (){
           Route::get('/', 'MainController@post')->name('user.blog.post');
           Route::get('comment', 'MainController@comment')->name('user.blog.comment');
           Route::get('like', 'MainController@like')->name('user.blog.like');
           Route::delete('unlike/{post}', 'MainController@unlike')->name('user.blog.unlike');
       });

    });

});




/****** ADMIN ******/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth.admin','verified','permission:admin-access']], function(){

    Route::get('/', 'MainController@index')->name('admin.index');
    /* BLOG */
    Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function(){
        /* CATEGORY */
        Route::resource('category', 'CategoryController')
            ->except(['show'])
            ->names('admin.blog.category');
        /* POST */
        Route::resource('post', 'PostController')
            ->except('show')
            ->names('admin.blog.post');
        Route::post('post/delete-image', 'PostController@ajaxDeleteImage')->name('admin.blog.post.delete-image');
    });

    /* USERS */
    Route::group(['namespace' => 'User'], function (){
        Route::resource('user', 'UserController')
            ->except(['show'])
            ->names('admin.user');
        //delete-avatar
        Route::post('user/delete-image', 'UserController@ajaxDeleteImage')->name('admin.user.delete-image');
        //auth user
        Route::post('user/auth-user', 'UserController@ajaxAuth')->name('admin.user.auth-user');
    });


});



Auth::routes(['verify' => true]);


