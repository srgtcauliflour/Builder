<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = [
        'site_id', 'type_id', 'name', 'desc', 'tags', 'repo'
    ];

    public function site()
    {
        return $this->hasOne('App\Site');
    }

    public function type()
    {
        return $this->hasOne('App\Type');
    }

    public function posts()
    {
        return $this->morphMany('App\Post', 'parentable');
    }
}
