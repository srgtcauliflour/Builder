<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'site_id', 'type_id', 'parentable_type', 'parentable_id', 'title', 'content'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function site()
    {
        return $this->hasOne('App\Site');
    }

    public function type()
    {
        return $this->hasOne('App\Type');
    }

    public function parentable()
    {
        return $this->morphTo();
    }

    public function sources()
    {
        return $this->morphMany('App\Source', 'parentable');
    }
}
