<?php

namespace App\Models\Blog;

use App\Models\User;
use Carbon\Carbon;
use Database\Factories\Blog\BlogPostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * Class BlogPost
 *
 * @package App\Models\Blog
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $slug
 * @property string $title
 * @property string $excerpt
 * @property string $content_raw
 * @property string $content_html
 * @property boolean $is_published
 * @property Carbon $published_at
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read BlogCategory $category
 * @property-read User $user
 * @method static BlogPostFactory factory(...$parameters)
 * @method static Builder|BlogPost newModelQuery()
 * @method static Builder|BlogPost newQuery()
 * @method static QueryBuilder|BlogPost onlyTrashed()
 * @method static Builder|BlogPost query()
 * @method static Builder|BlogPost whereCategoryId($value)
 * @method static Builder|BlogPost whereContentHtml($value)
 * @method static Builder|BlogPost whereContentRaw($value)
 * @method static Builder|BlogPost whereCreatedAt($value)
 * @method static Builder|BlogPost whereDeletedAt($value)
 * @method static Builder|BlogPost whereExcerpt($value)
 * @method static Builder|BlogPost whereId($value)
 * @method static Builder|BlogPost whereIsPublished($value)
 * @method static Builder|BlogPost wherePublishedAt($value)
 * @method static Builder|BlogPost whereSlug($value)
 * @method static Builder|BlogPost whereTitle($value)
 * @method static Builder|BlogPost whereUpdatedAt($value)
 * @method static Builder|BlogPost whereUserId($value)
 * @method static QueryBuilder|BlogPost withTrashed()
 * @method static QueryBuilder|BlogPost withoutTrashed()
 * @mixin \Eloquent
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
