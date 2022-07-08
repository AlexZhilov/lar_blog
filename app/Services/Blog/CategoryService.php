<?php


namespace App\Services\Blog;


use App\Models\Blog\Category;

class CategoryService
{
    public function store($data)
    {
        $category = (new Category)->create($data);
        flash("Категория '{$category->title}' создана.")->success();

        return $category;
    }

    public function update($data, Category $category)
    {
        $category->update($data);
        flash("Категория '{$category->title}' обновлена.")->success();
    }

    public function delete(Category $category)
    {
        $category->delete();
        flash("Категория '{$category->title}' удалена.");
    }
}