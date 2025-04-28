<?php


namespace App\Repositories\Blog;

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
                ->paginate($perPage);
    }
}