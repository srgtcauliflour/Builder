<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'user_id', 'type_id', 'name', 'desc'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function type()
    {
        return $this->hasOne('App\Type');
    }

    public function components()
    {
        return $this->hasMany('App\Component');
    }

    public function posts()
    {
        return $this->morphMany('App\Post', 'parentable');
    }
}
