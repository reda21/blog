<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use App\Services\Image;
use App\Services\ImplentationUser;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Laravel\Passport\HasApiTokens;
use Rennokki\Befriended\Traits\Block;
use Rennokki\Befriended\Traits\Follow;
use Spatie\Permission\Traits\HasRoles;
use OpenApi\Annotations as OA;

/**
 * App\Models\User
 * @OA\Schema(
 *     schema="User",
 *     description="mon discrpiotion",
 *     title="list utlisateur",
 *      @OA\Property(property="id", type="integer", description="id de model", example="15"),
 *      @OA\Property(property="name", type="string", description="fullname", example="jhon doe"),
 *      @OA\Property(property="email",type="string", description="email", example="jhondeo@exemple.com"),
 *      @OA\Property(property="created_at",type="string", format="date-time", description="created_at"),
 *      @OA\Property(property="updated_at",type="string", format="date-time", description="updated_at")
 * )
 *
 * @OA\Schema(
 *     schema="User-item",
 *     title="utlisateur",
 *     allOf={@OA\Schema(ref="#/components/schemas/User")},
 *     @OA\Property(property="description",type="string", description="description", example="this example description"),
 *     )
 * @property int $id
 * @property string $username
 * @property string $email
 * @property int $email_show
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read mixed $role_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|\App\Models\User newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withCacheCooldownSeconds($seconds = null)
 * @mixin \Eloquent
 *
 *
 */
class User extends Authenticatable implements ImplentationUser
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;
    use PresentableTrait;
    use Cachable;
    use Follow;
    use Block;

    /**
     * duration cache model
     * @var int
     */
    protected $cacheCooldownSeconds = 300; // 5 minutes

    /**
     * presenter name
     *
     * @var string
     */
    protected $presenter = UserPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "username", "first_name", 'last_name', 'email', 'password', "email_verified_at"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Build Social Relationships.
     *
     * @var array
     */
    public function social()
    {
        return $this->hasMany(Social::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function config()
    {
        return $this->hasOne(ConfigUser::class);
    }

    function getNameAttribute()
    {
        return $this->present()->fullName;

    }

    function showProfile()
    {
        //{  birthday:'{{$user->profile->birthday}}', description:'{{$user->profile->description}}' }
        return [
            "location" => $this->profile->location,
            "sexe" => $this->profile->sexe,
            "email_hidden" => $this->email_show ? 0 : 1,
            "facebook_username" => $this->profile->facebook_username,
            "twitter_username" => $this->profile->twitter_username,
            "pinterest_username" => $this->profile->pinterest_username,
            "google_plus_username" => $this->profile->google_plus_username,
            "dribbble_username" => $this->profile->dribbble_username,
            "github_username" => $this->profile->github_username,
            "birthday" => $this->profile->birthday ? $this->profile->birthday->format("d/m/Y") : "",
            "description" => $this->profile->description,
        ];
    }

    public function getRoleNameAttribute()
    {
        if ($this->roles()->count()) {
            return $this->roles->first()->name;
        }

        return null;

    }

    public function getAvatarAttribute()
    {
        return Image::getAvatarUser($this);

    }

    public function getCoverAttribute()
    {
        return Image::getCoverUser($this);
    }
}
