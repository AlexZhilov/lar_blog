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

//    Route::resource('posts', 'PostController')->names('blog.posts');

});

/****** ADMIN ******/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function(){

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
    });


});

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
