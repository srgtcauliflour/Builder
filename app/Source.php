<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'parentable_type', 'parentable_id', 'name', 'desc', 'size', 'mime_type'
    ];

    public function parentable()
    {
        return $this->morphTo();
    }
}
