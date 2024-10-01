<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class GetItemsController extends Controller
{
    public function index()
    {
        // Fetch all items with their category and availability
        $items = Item::with('category', 'availableItem')
            ->get(['id', 'name', 'img', 'available']);

        return response()->json($items);
    }

    public function show($id)
    {
        // Fetch specific item by ID with its category and availability
        $item = Item::with('category', 'availableItem')
            ->where('id', $id)
            ->firstOrFail(['id', 'name', 'img', 'available']);

        return response()->json($item);
    }
}
