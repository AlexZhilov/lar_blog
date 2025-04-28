<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User\User as Model;

class UserRepository extends BaseRepository
{


    protected function getModel()
    {
        return Model::class;
    }


    public function getById(int $id)
    {
        return $this->model()->findOrFail($id);
    }

    public function getAllWithRoleAndPaginate($perPage = 30)
    {
        return $this->model()
            ->orderBy('id', 'ASC')
            ->with(['roles:id,name,slug,text'])
            ->paginate($perPage);
    }

    public function getAllForDropList()
    {
        return $this->model()->pluck('name', 'id')->all();
    }
}
