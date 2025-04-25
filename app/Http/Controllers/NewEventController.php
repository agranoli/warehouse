<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewEventController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'file' => 'required|file|image|max:2048',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('images', 'public');
        }

        $event = new Event();
        $event->name = $request->input('name');
        $event->date_from = $request->input('date_from');
        $event->date_to = $request->input('date_to');
        $event->file = $filePath ? asset('storage/' . $filePath) : null;
        $event->save();

        return response()->json($event, 201);
    }
}
