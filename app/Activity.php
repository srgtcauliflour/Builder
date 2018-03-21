<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'type_id', 'parentable_type', 'parentable_id', 'name', 'content', 'status'
    ];

    public function parentable()
    {
        return $this->morphTo();
    }
}
