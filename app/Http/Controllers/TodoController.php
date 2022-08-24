<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoAddRequest;
use App\Http\Requests\TodoRenameRequest;
use App\Http\Requests\TodoUpdateRequest;
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

    public function update(TodoUpdateRequest $request, TodoItem $item)
    {
        $item->is_checked = $request->boolean('value');

        $item->save();

        return response()->json();
    }

    public function add(TodoAddRequest $request)
    {
        $item = new TodoItem;

        $item->name = $request->input('name');

        $item->save();

        return response()->json( $item->fresh() );
    }

    public function remove(TodoItem $item)
    {
        $item->delete();

        return response()->json();
    }

    public function rename(TodoRenameRequest $request, TodoItem $item)
    {
        $item->name = $request->input('name');

        $item->save();

        return response()->json();
    }
}
