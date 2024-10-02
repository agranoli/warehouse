<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;  // Assuming your model is named Item

class GetAvailableItems extends Controller
{
    // Method to fetch available items (where available > 0)
    public function getAvailableItems(): \Illuminate\Http\JsonResponse
    {
        try {
            // Fetch all items where 'available' count is greater than 0
            $availableItems = Item::where('available', '>', 0)->get();

            // Return the data as JSON
            return response()->json($availableItems, 200);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json([
                'message' => 'Error fetching available items',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
