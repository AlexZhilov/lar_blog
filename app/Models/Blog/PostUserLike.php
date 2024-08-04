<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\PostUserLike
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @method static \Illuminate\Database\Eloquent\Builder|PostUserLike newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostUserLike newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostUserLike query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostUserLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostUserLike wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostUserLike whereUserId($value)
 * @mixin \Eloquent
 */
class PostUserLike extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'blog_post_user_likes';
}
