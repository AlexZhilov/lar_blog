<?php

namespace App\Models\Blog;

use App\Models\User\User;
use Carbon\Carbon;
use Database\Factories\Blog\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Date;

/**
 * Class Post
 *
 * @package App\Models\Blog
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $slug
 * @property string $title
 * @property string $excerpt
 * @property string $content
 * @property boolean $is_published
 * @property Carbon $published_at
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Category $category
 * @property-read User $user
 * @method static PostFactory factory(...$parameters)
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static QueryBuilder|Post onlyTrashed()
 * @method static Builder|Post query()
 * @method static Builder|Post whereCategoryId($value)
 * @method static Builder|Post whereContentHtml($value)
 * @method static Builder|Post whereContentRaw($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDeletedAt($value)
 * @method static Builder|Post whereExcerpt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereIsPublished($value)
 * @method static Builder|Post wherePublishedAt($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereUserId($value)
 * @method static QueryBuilder|Post withTrashed()
 * @method static QueryBuilder|Post withoutTrashed()
 * @property string|null $image
 * @property int $views
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereImage($value)
 * @method static Builder|Post whereViews($value)
 * @method static Builder|Post published()
 * @method static Builder|Post slug($slug)
 * @property int $status
 * @property-read bool $is_active
 * @method static Builder|Post whereStatus($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_posts';

    protected $guarded = [];

    protected $dates = [
        'published_at',
        'deleted_at',
    ];

    #### SCOPES ####

    public function scopePublished(Builder $builder): void
    {
        $builder->where('status', true);
        $builder->where('published_at', '<=', now());
    }

    public function scopeSlug(Builder $builder, string $slug): void
    {
        $builder->where('slug', $slug);
    }


    #### ACCESSORS ####

    public function getIsActiveAttribute(): bool
    {
        return $this->attributes['status'] === 1;
    }

    public function getIsPublishedAttribute(): bool
    {
        return $this->is_active && Date::parse($this->published_at)->isPast();
    }

    public function getPublishedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    #### RELATIONS ####

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault(['title' => 'NULL']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blog_post_tag');
    }

    public function attributeNames()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'views' => 'Просмотры',
            'is_published' => 'Опубликовано',
            'category_id' => 'Категория',
            'user_id' => 'Автор',
            'slug' => 'Slug',
            'excerpt' => 'Описание',
            'image' => 'Изображение',
            'status' => 'Статус',
            'published_at' => 'Дата публикации',
        ];
    }

    public function getAttributeLabel(string $key): string
    {
        $names = $this->attributeNames();
        return $names[$key] ?? ucwords(str_replace('_', ' ', $key));
    }
}
