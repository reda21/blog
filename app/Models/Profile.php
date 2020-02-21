<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string $sexe
 * @property \Illuminate\Support\Carbon|null $birthday
 * @property string|null $location
 * @property string|null $bio
 * @property string|null $url
 * @property string|null $twitter_username
 * @property string|null $facebook_username
 * @property string|null $google_plus_username
 * @property string|null $pinterest_username
 * @property string|null $dribbble_username
 * @property string|null $github_username
 * @property string|null $avatar
 * @property int $avatar_status
 * @property string|null $cover
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereAvatarStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereDribbbleUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereFacebookUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereGithubUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereGooglePlusUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePinterestUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereTwitterUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUserId($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'sexe',
        "birthday",
        'location',
        'bio',
        'url',
        'twitter_username',
        'github_username',
        'twitter_username',
        'facebook_username',
        'github_username',
        'pinterest_username',
        'dribbble_username',
        'avatar',
        'avatar_status',
        "cover"
    ];

    protected $dates = [
        "birthday"
    ];

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
