<?php

namespace App\Models\User;

use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\User\Traits\HasRolesAndPermissions;
use Carbon\Carbon;
use Database\Factories\User\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Class User
 *
 * @package App\Models
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property Carbon $email_verified_at
 * @property Carbon $last_activity
 * @property string $avatar
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Post[] $posts
 * @property-read int|null $posts_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @property-read Collection|\App\Models\User\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|\App\Models\User\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|Comment[] $postsComment
 * @property-read int|null $posts_comment_count
 * @property-read Collection|Post[] $postsLiked
 * @property-read int|null $posts_liked_count
 * @method static Builder|User whereActive($value)
 * @method static Builder|User whereAvatar($value)
 * @property string|null $deleted_at
 * @property-read string $created_at_format
 * @property-read string $deleted_at_format
 * @property-read string $last_activity_format
 * @property-read string $updated_at_format
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereLastActivity($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;


    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_activity' => 'datetime',
    ];


    /**
     * Override parent boot and Call deleting event
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($users) {
            foreach ($users->posts()->get() as $post) {
                $post->delete();
            }
        });
    }

    ####### ACCESSORS #######

    public function getUpdatedAtFormatAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function getCreatedAtFormatAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function getDeletedAtFormatAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function getLastActivityFormatAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    ####### ACTIONS #######

    public function updateLastActivity(): void
    {
        $this->updateQuietly(['last_activity' => now()]);
    }

    ####### CONDITIONS #######

    public function isActive(): bool
    {
        return !is_null($this->email_verified_at);
    }


    ####### RELATIONS #######

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->orderBy('blog_posts.id', 'DESC');
    }

    public function postsLiked(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'blog_post_user_likes', 'user_id');
    }

    public function postsComment(): HasMany
    {
        return $this->hasMany(Comment::class)->with('post');
    }
}
