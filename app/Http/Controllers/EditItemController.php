<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\AvailableItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditItemController extends Controller
{
    public function update(Request $request, $id)
    {
        // Retrieve the item by ID
        $item = Item::find($id);

        // Check if the item exists
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|integer|exists:categories,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            'img' => 'sometimes|file|image|max:2048',
        ]);

        // Handle the image file upload if a new file is provided
        if ($request->hasFile('img')) {
            $filePath = $request->file('img')->store('images', 'public');
            $validatedData['img'] = $filePath;
        }

        // Update the item with the validated data
        $item->update($validatedData);

        // Update the availability information in the 'available_items' table
        if (isset($validatedData['quantity'])) {
            $availableItem = AvailableItem::where('item_id', $item->id)->first();
            if ($availableItem) {
                $availableItem->available = $validatedData['quantity'];
                $availableItem->save();
            }
        }

        // Return the updated item as a JSON response
        return response()->json(['message' => 'Item updated successfully', 'item' => $item]);
    }
}
