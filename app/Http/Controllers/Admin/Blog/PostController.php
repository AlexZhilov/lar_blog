<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\Post\Request as PostRequest;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Repositories\Blog\CategoryRepository as BlogCategoryRepository;
use App\Repositories\Blog\PostRepository as BlogPostRepository;
use App\Services\Blog\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PostController extends BaseController
{

    private $blogPostRepository;
    private $blogCategoryRepository;

    public function __construct(
        PostService $service,
        BlogPostRepository $blogPostRepository,
        BlogCategoryRepository $blogCategoryRepository
    )
    {
        parent::__construct();
        $this->service = $service;
        $this->blogPostRepository = $blogPostRepository;
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.blog.post.index',[
            'posts' => $this->blogPostRepository->getAllWithCategoryAndPaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function create(Post $post)
    {
        $tags = Tag::pluck('title', 'id');
        $categories = $this->blogCategoryRepository->getAllForDropList();
        return view('admin.blog.post.store', compact('categories', 'post', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = $this->service->store( collect($request->validated()) );
        return redirect()->route('admin.blog.post.edit', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $tags = Tag::pluck('title', 'id');
        $categories = $this->blogCategoryRepository->getAllForDropList();
        return view('admin.blog.post.store', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
//        dd($request->file('image'));
        $this->service->update( collect($request->validated()), $post );
        return redirect()->route('admin.blog.post.edit', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->service->delete($post);
        return redirect()->route('admin.blog.post.index');
    }

    public function ajaxDeleteImage()
    {
        $post = $this->blogPostRepository->getById(request('id'));
        $this->service->removeImage($post);
//        return $post;
    }

}
