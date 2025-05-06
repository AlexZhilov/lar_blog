<?php

namespace App\Repositories\User;

use App\Filters\User\LastLoginFilter;
use App\Repositories\BaseRepository;
use App\Models\User\User as Model;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository extends BaseRepository
{
    protected function getModel()
    {
        return Model::class;
    }

        public function getAllWithPaginate(Request $request, $perPage = 20)
    {
        return QueryBuilder::for($this->model())
            ->allowedFilters([
                'id',
                AllowedFilter::partial('name'),
                AllowedFilter::partial('email'),
                AllowedFilter::custom('last_login', new LastLoginFilter),
                AllowedFilter::callback('created_between', function ($query, $value) {
                    $dates = explode(',', $value);
                    if (count($dates) === 2) {
                        $query->whereBetween('created_at', $dates);
                    }
                }),
                // Поиск по нескольким полям сразу
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where(function ($query) use ($value) {
                        $query->where('name', 'LIKE', "%{$value}%")
                            ->orWhere('email', 'LIKE', "%{$value}%");
                    });
                }),
                // Фильтр по наличию проверенного email
                AllowedFilter::callback('verified', function ($query, $value) {
                    if ($value === 'yes') {
                        $query->whereNotNull('email_verified_at');
                    } elseif ($value === 'no') {
                        $query->whereNull('email_verified_at');
                    }
                }),
                // Фильтр по связанной роли
                AllowedFilter::callback('role', function ($query, $value) {
                    $query->whereHas('roles', function ($query) use ($value) {
                        $query->where('id', $value);
                    });
                }),
            ])
            ->allowedSorts('id', 'name', 'email', 'last_login')
            ->with(['roles:id,name,slug,text'])
            ->orderByDesc('id')
            ->paginate(request('per_page', $perPage))
            ->appends(request()->query());
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
