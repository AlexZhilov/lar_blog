<?php


namespace App\Services\Blog;


use App\Models\Blog\Category;

class CategoryService
{
    public function store($data)
    {
        return (new Category)->create($data);
    }

    public function update($data, Category $category)
    {
        $category->update($data);
    }

    public function delete(Category $category)
    {
        $category->delete();
    }
}