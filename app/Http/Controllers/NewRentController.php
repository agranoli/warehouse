<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewRentController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('Received request data:', $request->all()); // Log the incoming request data

        $request->validate([
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.date_from' => 'required|date',
            'items.*.date_to' => 'required|date|after_or_equal:items.*.date_from',
            'items.*.quantity' => 'required|integer|min:1', // Validate quantity
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->input('items') as $itemData) {
                $item = Item::find($itemData['item_id']);
                $quantity = $itemData['quantity'];

                if ($item->availableItem && $item->availableItem->available >= $quantity) {
                    $item->availableItem->decrement('available', $quantity);

                    $rent = new Rent();
                    $rent->item_id = $item->id;
                    $rent->date_from = $itemData['date_from'];
                    $rent->date_to = $itemData['date_to'];
                    $rent->user_id = Auth::id();
                    $rent->quantity = $quantity; // Set the quantity
                    $rent->save();
                } else {
                    throw new \Exception("Item with ID {$item->id} is not available in the requested quantity");
                }
            }

            DB::commit();

            return response()->json(['message' => 'Rents created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
