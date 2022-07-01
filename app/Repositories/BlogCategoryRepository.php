<?php


namespace App\Repositories;

use App\Models\Blog\BlogCategory as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModel()
    {
        return Model::class;
    }

    /**
     * @param $id
     * @return Application|Model|mixed
     */
    public function getCategoryById($id)
    {
        return $this->model()->find($id);
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPostsWithParentAndPaginate($perPage = 10)
    {
        return $this->model()->with('parent')->paginate($perPage);
    }

    /**
     * @return array
     */
    public function getAllForDropList()
    {
        return $this->model()->pluck('title', 'id')->all();
    }


}