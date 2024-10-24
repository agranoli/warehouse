<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class GetRentController extends Controller
{
    public function index()
    {
        // Eager load the related item data
        $rents = Rent::with('item')->get();

        // Format the response to include item details
        $formattedRents = $rents->map(function ($rent) {
            return [
                'id' => $rent->id,
                'user_id' => $rent->user_id,
                'date_from' => $rent->date_from,
                'date_to' => $rent->date_to,
                'item' => [
                    'id' => $rent->item->id,
                    'name' => $rent->item->name,
                    'category' => $rent->item->category ? $rent->item->category->name : null,
                    'img' => $rent->item->img,
                ],
            ];
        });

        return response()->json($formattedRents);
    }

    public function show($id)
    {
        // Eager load the related item data
        $rent = Rent::with('item')->findOrFail($id);

        // Format the response to include item details
        $formattedRent = [
            'id' => $rent->id,
            'user_id' => $rent->user_id,
            'date_from' => $rent->date_from,
            'date_to' => $rent->date_to,
            'item' => [
                'id' => $rent->item->id,
                'name' => $rent->item->name,
                'category' => $rent->item->category ? $rent->item->category->name : null,
                'img' => $rent->item->img,
            ],
        ];

        return response()->json($formattedRent);
    }
}
