<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class NewItemController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('Incoming request data:', $request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'img' => 'required|string'
        ]);

        Item::create($validatedData);

        return response()->json(['message' => 'Item created successfully.'], 201);
    }
}
