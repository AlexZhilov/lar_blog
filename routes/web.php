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

/******* SITE ******/
/* BLOG */
Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function(){

    Route::resource('posts', 'PostController')->names('blog.posts');

});

/****** ADMIN ******/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function(){

    /* BLOG */
    Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function(){
        Route::resource('categories', 'CategoryController')
            ->except(['show'])
            ->names('admin.blog.categories');
    });


});



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
