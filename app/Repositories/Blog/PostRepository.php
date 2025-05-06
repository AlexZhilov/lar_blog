<?php


namespace App\Repositories\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post as Model;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function getAllWithPaginate(Request $request, int $perPage = 30): LengthAwarePaginator
    {
        return QueryBuilder::for($this->model())
            ->allowedFilters([
                'id',
                AllowedFilter::partial('title'),
                AllowedFilter::partial('slug'),
                AllowedFilter::callback('created_between', function ($query, $value) {
                    $dates = explode(',', $value);
                    if (count($dates) === 2) {
                        $query->whereBetween('created_at', $dates);
                    }
                }),
                // Поиск по нескольким полям сразу
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where(function ($query) use ($value) {
                        $query->where('title', 'LIKE', "%{$value}%")
                            ->orWhere('content', 'LIKE', "%{$value}%")
                            ->orWhere('slug', 'LIKE', "%{$value}%");
                    });
                }),
                // Фильтр по связанной категории
                AllowedFilter::callback('category', function ($query, $value) {
                    $query->whereHas('category', function ($query) use ($value) {
                        $query->where('id', $value);
                    });
                }),
                // Фильтр по связанному пользователю
                AllowedFilter::callback('user', function ($query, $value) {
                    $query->whereHas('user', function ($query) use ($value) {
                        $query->where('id', $value);
                    });
                }),
                // Публикация
                AllowedFilter::callback('status', function ($query, $value) {
                    if ($value === 'yes') {
                        $query->whereNotNull('published_at');
                    } elseif ($value === 'no') {
                        $query->whereNull('published_at');
                    }
                }),
            ])
            ->allowedSorts([
                'id',
                'title',
                'slug',
                'created_at',
                'published_at'
            ])
            ->with(['category:id,title,slug', 'user:id,name'])
            ->orderBy('id', 'DESC')
            ->paginate(request()->get('per_page', $perPage))
            ->appends(request()->query());
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