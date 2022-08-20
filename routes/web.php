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
        Route::post('post/delete-image', 'PostController@ajaxDeleteImage')->name('admin.blog.post.delete-image');
    });


});



Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
