<?php

namespace App\Repositories\User;

use App\Models\User\Permission as Model;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PermissionRepository extends BaseRepository
{

    protected function getModel()
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->model()->all();
    }

    public function getBySlug($slug)
    {
        return $this->model()->where('slug', $slug)->first();
    }

    public function getBySlugIn(array $slugArr)
    {
        return $this->model()->whereIn('slug', $slugArr)->get();
    }

    public function getList()
    {
        return $this->model()->pluck('name', 'id');
    }

    public function getAllWithPaginate($perPage = 20): LengthAwarePaginator
    {
        return $this->model()
            ->with(['roles', 'users'])
            ->paginate($perPage);
    }

}