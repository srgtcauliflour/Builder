<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * Mass assignable
     */
    protected $fillable = [
        'name', 'priority', 'type', 'desc', 'note'
    ];
}
