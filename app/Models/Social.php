<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_logins';

    /*
     * Define an inverse one-to-one or many relationship with User Model
     */
    public function user():string
    {
        return $this->belongsTo(User::class);
    }
}
