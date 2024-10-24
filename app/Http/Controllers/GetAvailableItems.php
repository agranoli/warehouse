<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;  // Assuming your model is named Item

class GetAvailableItems extends Controller
{
    public function getAvailableItems(): \Illuminate\Http\JsonResponse
    {
        try {
            $availableItems = Item::where('available', '>', 0)->get();

            return response()->json($availableItems, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching available items',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
