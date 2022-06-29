<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategory
 * @package App\Models\Blog
 *
 * @property int        id
 * @property int        parent_id
 * @property string     slug
 * @property string     title
 * @property string     description
 * @property datetime   created_at
 * @property datetime   updated_at
 * @property datetime   deleted_at
 */
class BlogCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }
}
