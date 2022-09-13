<?php

namespace App\Repositories\User;

use App\Repositories\CoreRepository;
use App\Models\User\Permission as Model;

class PermissionRepository extends CoreRepository
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

}