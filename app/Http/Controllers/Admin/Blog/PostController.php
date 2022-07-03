<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Blog\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Services\Blog\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Blog\Post\Request as PostRequest;
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        dd(123);
        $this->service->update( $request->validated(), $post );
        return redirect()->route('admin.blog.post.index', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
