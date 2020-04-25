<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config_users';

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
        'private_compte',
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
