<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\Category\Request as CategoryRequest;
use App\Models\Blog\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use App\Services\Blog\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{

    private $blogCategoryRepository;

    public function __construct(
        CategoryService $service,
        BlogCategoryRepository $blogCategoryRepository
    )
    {
        parent::__construct();
        $this->service = $service;
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.blog.category.index', [
            'categories' => $this->blogCategoryRepository->getPostsWithParentAndPaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param BlogCategory $category
     * @return Application|Factory|View
     */
    public function create(BlogCategory $category)
    {
        $categories = $this->blogCategoryRepository->getAllForDropList();
        return view('admin.blog.category.store', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->service->store( $request->validated() );
        return redirect()->route('admin.blog.categories.edit', $category->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogCategory $category
     * @return Application|Factory|View
     */
    public function edit(BlogCategory $category)
    {
        $categories = $this->blogCategoryRepository->getAllForDropList();
        return view('admin.blog.category.store', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param BlogCategory $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, BlogCategory $category)
    {
        $this->service->update( $request->validated(), $category);

        return redirect()->route('admin.blog.categories.edit', $category->id);
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
