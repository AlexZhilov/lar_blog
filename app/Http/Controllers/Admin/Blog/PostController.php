<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\Post\Request as PostRequest;
use App\Models\Blog\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
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
     * @param BlogPost $post
     * @return Application|Factory|View
     */
    public function create(BlogPost $post)
    {
        $categories = $this->blogCategoryRepository->getAllForDropList();
        return view('admin.blog.post.store', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = $this->service->store( $request->validated() );
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
     * @param BlogPost $post
     * @return Application|Factory|View
     */
    public function edit(BlogPost $post)
    {
        $categories = $this->blogCategoryRepository->getAllForDropList();
        return view('admin.blog.post.store', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param BlogPost $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, BlogPost $post)
    {
        $this->service->update( $request->validated(), $post );
        return redirect()->route('admin.blog.post.edit', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogPost $post
     * @return RedirectResponse
     */
    public function destroy(BlogPost $post)
    {
        $this->service->delete($post);
        return redirect()->route('admin.blog.post.index');
    }
}
