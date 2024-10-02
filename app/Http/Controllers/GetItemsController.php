<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class GetItemsController extends Controller
{
    public function index()
    {
        // Fetch all items with their category and availableItem relationships
        $items = Item::with('category', 'availableItem')->get();

        // Format the response to include the necessary fields
        $formattedItems = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'img' => $item->img,
                'available' => $item->availableItem ? $item->availableItem->available : null, // Fetch available from the related availableItem
                'category' => $item->category ? $item->category->name : null,  // Fetch category name
            ];
        });

        return response()->json($formattedItems);
    }

    public function show($id)
    {
        // Fetch a single item by ID with its category and availableItem relationships
        $item = Item::with('category', 'availableItem')->where('id', $id)->firstOrFail();

        // Format the response to include the necessary fields
        $formattedItem = [
            'id' => $item->id,
            'name' => $item->name,
            'img' => $item->img,
            'available' => $item->availableItem ? $item->availableItem->available : null, // Fetch available from the related availableItem
            'category' => $item->category ? $item->category->name : null,  // Fetch category name
        ];

        return response()->json($formattedItem);
    }
}
