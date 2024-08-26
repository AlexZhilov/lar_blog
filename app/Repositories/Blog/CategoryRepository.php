<?php


namespace App\Repositories\Blog;

use App\Models\Blog\Category as Model;
use App\Repositories\CoreRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository extends CoreRepository
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

    public function getAllWithPaginate(int $perPage = 10): LengthAwarePaginator
    {
        $result = $this->model()
//                ->select(['id','slug','title'])
            ->orderBy('id', 'DESC')
            ->with('parent')
            ->withCount('posts')
//            ->toBase()
            ->paginate($perPage);
//        dd($result);
        return $result;
    }

    /**
     * @return array
     */
    public function getAllForDropList()
    {
        return $this->model()->pluck('title', 'id')->all();
    }


}