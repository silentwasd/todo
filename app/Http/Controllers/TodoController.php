<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index()
    {
        $items = TodoItem::get();

        return Inertia::render('Todo', [
            'items' => $items
        ]);
    }
}
