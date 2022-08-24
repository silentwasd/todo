<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    public $timestamps = false;

    protected $casts = [
        'is_checked' => 'boolean'
    ];
}
