<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use BroadcastsEvents;

    public $timestamps = false;

    protected $casts = [
        'is_checked' => 'boolean'
    ];

    public function broadcastOn($event): array
    {
        return [
            new Channel('App.Models.TodoItem')
        ];
    }
}
