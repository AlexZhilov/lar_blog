<?php 

namespace App\Repositories\Blog;

use App\Repositories\BaseRepository;
use App\Models\Blog\Tag; // Исправлено на правильное пространство имен
use Illuminate\Database\Eloquent\Model;

/**
 * Class TagRepository
 * @package App\Repositories
 *
 * @method Model model()
 */
class TagRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function getModel()
    {
        return Tag::class;
    }
    
    public function getById(int $id)
    {
        return $this->model()->findOrFail($id);
    }

    public function getTagCloud()
    {
        return $this->model()
            ->withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->get();
    }
}
