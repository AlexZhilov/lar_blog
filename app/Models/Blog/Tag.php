<?php

namespace App\Models\Blog;

use Database\Factories\Blog\TagFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Blog\Tag
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Post[] $posts
 * @property-read int|null $posts_count
 * @method static TagFactory factory(...$parameters)
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 * @method static Builder|Tag whereCreatedAt($value)
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereSlug($value)
 * @method static Builder|Tag whereTitle($value)
 * @method static Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'blog_tags';

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'blog_post_tag');
    }

}
