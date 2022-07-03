<?php


namespace App\Repositories;

use App\Models\Blog\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{

    protected function getModel()
    {
        return Model::class;
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