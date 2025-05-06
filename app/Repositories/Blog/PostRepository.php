<?php


namespace App\Repositories\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post as Model;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PostRepository
 * @package App\Repositories
 *
 * @method Model model()
 */
class PostRepository extends BaseRepository
{
    protected function getModel()
    {
        return Model::class;
    }

    public function getById(int $id)
    {
        return $this->model()->findOrFail($id);
    }

    public function getAllWithPaginate(int $perPage = 30): LengthAwarePaginator
    {
        return $this->model()
                ->orderBy('id', 'DESC')
                ->with(['category:id,title,slug', 'user:id,name'])
                ->orderBy('id', 'DESC')
                ->paginate($perPage);
    }

    public function getAllActiveWithPaginate(int $perPage = 30): LengthAwarePaginator
    {
        return $this->model()
                ->published()
                ->with(['category:id,title,slug', 'user:id,name'])
                ->orderBy('blog_posts.created_at', 'DESC')
                ->paginate($perPage);
    }


    public function getAllActiveByCategoryWithPaginate(Category $category, int $perPage = 30): LengthAwarePaginator
    {
        return $category
            ->posts()
            ->published()
            ->with(['category:id,title,slug', 'user:id,name'])
            ->orderBy('blog_posts.created_at', 'DESC')
            ->paginate($perPage);
    }
}