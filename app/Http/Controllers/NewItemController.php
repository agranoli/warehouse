<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\AvailableItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewItemController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'img' => 'required|file|image|max:2048',
        ]);

        $filePath = null;

        if ($request->hasFile('img')) {
            $filePath = $request->file('img')->store('images', 'public');
        }

        $item = new Item();
        $item->name = $request->input('name');
        $item->category_id = $request->input('category_id');
        $item->quantity = $request->input('quantity');
        $item->price = $request->input('price');
        $item->img = $filePath ? asset('storage/' . $filePath) : null;
        $item->save();

        $availableItem = new AvailableItem();
        $availableItem->item_id = $item->id;
        $availableItem->available = $item->quantity;
        $availableItem->save();

        return response()->json($item, 201);
    }
}
