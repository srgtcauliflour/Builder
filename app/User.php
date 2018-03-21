<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'country', 'email', 'token', 'type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'token'
    ];

    /**
     * @return HasOne relationship
     */
    public function type()
    {
        return $this->hasOne('App\Type');
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'parentable');
    }
}
