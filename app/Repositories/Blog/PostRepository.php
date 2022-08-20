<?php


namespace App\Repositories\Blog;

use App\Models\Blog\Post as Model;
use App\Repositories\CoreRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PostRepository
 * @package App\Repositories
 *
 * @method Model model()
 */
class PostRepository extends CoreRepository
{

    protected function getModel()
    {
        return Model::class;
    }

    public function getById(int $id)
    {
        return $this->model()->findOrFail($id);
    }


    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithCategoryAndPaginate($perPage = 30)
    {
        return $this->model()
                ->orderBy('id', 'DESC')
                ->with(['category:id,title,slug', 'user:id,name'])
                ->paginate($perPage);
    }
}