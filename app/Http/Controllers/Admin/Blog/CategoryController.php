<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\CategoryRequest as CategoryRequest;
use App\Models\Blog\Category;
use App\Repositories\Blog\CategoryRepository as BlogCategoryRepository;
use App\Services\Blog\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends BaseController
{

    private CategoryService $service;

    private BlogCategoryRepository $categories;

    public function __construct(
        CategoryService $service,
        BlogCategoryRepository $blogCategoryRepository
    )
    {
        parent::__construct();
        $this->service = $service;
        $this->categories = $blogCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.blog.category.index', [
            'categories' => $this->categories->getAllWithPaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function create(Category $category)
    {
        $categories = $this->categories->getAllForDropList();
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
        $category = $this->service->store($request->validated());
        return redirect()->route('admin.blog.category.edit', $category->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        $categories = $this->categories->getAllForDropList();
        return view('admin.blog.category.store', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->service->update($request->validated(), $category);
        return redirect()->route('admin.blog.category.edit', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        $this->service->delete($category);
        return redirect()->route('admin.blog.category.index');
    }
}
