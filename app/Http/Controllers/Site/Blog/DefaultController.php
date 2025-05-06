<?php

namespace App\Http\Controllers\Site\Blog;

use App\Http\Controllers\Site\BaseController;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Repositories\Blog\CategoryRepository;
use App\Repositories\Blog\PostRepository;

class DefaultController extends BaseController
{
    private PostRepository $posts;
//    private CategoryRepository $categories;

    public function __construct(
        PostRepository $posts,
        CategoryRepository $categories
    )
    {
        $this->posts = $posts;
//        $this->categories = $categories;

        parent::__construct();
    }

    public function index()
    {
        return view('site.blog.index', [
            'posts' => $this->posts->getAllActiveWithPaginate(),
        ]);
    }

    public function category(Category $category)
    {
        return view('site.blog.index', [
            'posts' => $this->posts->getAllActiveByCategoryWithPaginate($category)
        ]);
    }

    public function post(Category $category, Post $post)
    {
        return view('site.blog.post', [
            'category' => $category,
            'post' => $post
        ]);
    }

    public function tag(Tag $tag)
    {
        return view('site.blog.index', [
            'posts' => $tag->posts()->paginate(10)
        ]);
    }

}
