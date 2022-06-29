<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\Category\Request as CategoryRequest;
use App\Models\Blog\BlogCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogCategory $category
     * @return Application|Factory|View
     */
    public function edit(BlogCategory $category)
    {
        $allCategories = BlogCategory::all();
        return view('admin.blog.category.edit', compact('category', 'allCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param BlogCategory $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, BlogCategory $category)
    {
        $data = $request->validated();
        $category->update($data);
        flash("Категория '{$category->title}' обновлена.")->success();
        return redirect()->route('admin.blog.categories.index');
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
