<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\Category\Request as CategoryRequest;
use App\Models\Blog\BlogCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = BlogCategory::with('parent')->paginate(10);
        return view('admin.blog.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param BlogCategory $category
     * @return Application|Factory|View
     */
    public function create(BlogCategory $category)
    {
        $categories = BlogCategory::all();
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
        $category = BlogCategory::create( $request->validated() );
        flash("Категория '{$category->title}' создана.")->success();

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
        $categories = BlogCategory::all();
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
        $category->update( $request->validated() );
        flash("Категория '{$category->title}' обновлена.")->success();

//        return redirect()->route('admin.blog.categories.index');
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
