<?php

namespace App\Models\Blog;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package App\Models\Blog
 *
 * @property integer    $id
 * @property integer    $category_id
 * @property integer    $user_id
 * @property string     $slug
 * @property string     $title
 * @property string     $excerpt
 * @property string     $content_raw
 * @property string     $content_html
 * @property boolean    $is_published
 * @property Carbon     $published_at
 * @property Carbon     $deleted_at
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 *
 */
class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $dates = [
        'published_at',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
