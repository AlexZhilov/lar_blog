<?php


namespace App\Services\Blog;


use App\Models\Blog\BlogCategory;

class CategoryService
{
    public function store($data)
    {
        $category = (new BlogCategory)->create($data);
        flash("Категория '{$category->title}' создана.")->success();

        return $category;
    }

    public function update($data, BlogCategory $category)
    {
        $category->update($data);
        flash("Категория '{$category->title}' обновлена.")->success();
    }

    public function delete(BlogCategory $category)
    {
        $category->delete();
        flash("Категория '{$category->title}' удалена.");
    }
}