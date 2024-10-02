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
            'img' => 'required|file|image|max:2048', // Validate that img is an image file and its size
        ]);

        // Handle the image file upload
        if ($request->hasFile('img')) {
            $filePath = $request->file('img')->store('images', 'public'); // Store image in the 'public/images' directory
        }

        // Store the new item in the 'items' table
        $item = new Item();
        $item->name = $request->input('name');
        $item->category_id = $request->input('category_id');
        $item->quantity = $request->input('quantity');
        $item->price = $request->input('price');
        $item->img = $filePath; // Save the file path
        $item->save();

        // Store the availability information in the 'available_items' table
        $availableItem = new AvailableItem();
        $availableItem->item_id = $item->id; // Link to the newly created item
        $availableItem->available = $item->quantity; // Set the available amount to the item's quantity
        $availableItem->save();

        // Return the response
        return response()->json($item, 201);
    }
}
