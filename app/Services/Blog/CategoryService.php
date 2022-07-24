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
        $this->deleteChildCategoryAndPost($category);
        $category->delete();
    }

    /**
     * Рекурсивное удаление всех категорий и постов
     *
     * @param Category $category
     */
    private function deleteChildCategoryAndPost(Category $category)
    {
        foreach ($category->posts()->get() as $post){
            $post->delete();
        }

        foreach ($category->children()->get() as $child){
            $child->delete();
            $this->deleteChildCategoryAndPost($child);
        }
    }
}