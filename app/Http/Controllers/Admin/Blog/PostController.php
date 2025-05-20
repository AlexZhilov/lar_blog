<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\PostRequest;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Repositories\Blog\CategoryRepository as BlogCategoryRepository;
use App\Repositories\Blog\PostRepository as BlogPostRepository;
use App\Repositories\User\UserRepository;
use App\Services\Blog\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    private PostService $service;
    private BlogPostRepository $posts;
    private BlogCategoryRepository $categories;
    private UserRepository $users;

    public function __construct(
        PostService            $service,
        BlogPostRepository     $posts,
        BlogCategoryRepository $categories,
        UserRepository         $users
    )
    {
        $this->service = $service;
        $this->posts = $posts;
        $this->categories = $categories;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        return view('admin.blog.post.index', [
            'posts' => $this->posts->getAllWithPaginate($request),
            'users' => $this->users->getAllForDropList(),
            'categories' => $this->categories->getAllForDropList()
        ]);
    }

    public function create(Post $admin_post)
    {
        return view('admin.blog.post.store', [
            'post' => $admin_post,
            'tags' => Tag::pluck('title', 'id'),
            'categories' => $this->categories->getAllForDropList()
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $post = $this->service->store($request);
        return redirect()->route('admin.blog.post.edit', $post->id);
    }

    public function show($id)
    {
        dd(__METHOD__);
    }

    public function edit(Post $admin_post)
    {
        return view('admin.blog.post.store', [
            'post' => $admin_post,
            'categories' => $this->categories->getAllForDropList(),
            'tags' => Tag::pluck('title', 'id'),
            'users' => $this->users->getAllForDropList()
        ]);
    }

    public function update(PostRequest $request, Post $admin_post)
    {
        $this->service->update($request, $admin_post);
        return redirect()->route('admin.blog.post.edit', $admin_post->id);
    }

    public function destroy(Post $post)
    {
        $this->service->delete($post);
        return redirect()->route('admin.blog.post.index');
    }

    public function ajaxDeleteImage()
    {
        $post = $this->posts->getById(request('id'));
        $this->service->removeImage($post);
//        return $post;
    }

}
