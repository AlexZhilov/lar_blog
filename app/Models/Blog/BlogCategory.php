<?php

namespace App\Models\Blog;

use Carbon\Carbon;
use Database\Factories\Blog\BlogCategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class BlogCategory
 * @package App\Models\Blog
 *
 * @property int $id
 * @property int $parent_id
 * @property string $slug
 * @property string $title
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static BlogCategoryFactory factory(...$parameters)
 * @method static Builder|BlogCategory newModelQuery()
 * @method static Builder|BlogCategory newQuery()
 * @method static Builder|BlogCategory query()
 * @method static Builder|BlogCategory whereCreatedAt($value)
 * @method static Builder|BlogCategory whereDeletedAt($value)
 * @method static Builder|BlogCategory whereDescription($value)
 * @method static Builder|BlogCategory whereId($value)
 * @method static Builder|BlogCategory whereParentId($value)
 * @method static Builder|BlogCategory whereSlug($value)
 * @method static Builder|BlogCategory whereTitle($value)
 * @method static Builder|BlogCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlogCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }
}
