<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class NewEventController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'img' => 'required|file|image|max:2048',
        ]);

        // Handle file uploads
        $filePath = null;
        if ($request->hasFile('img')) {
            $filePath = $request->file('img')->store('images', 'public'); // Store image in the 'public/images' directory
            // Debugging: Check if the file path is set
            if (!$filePath) {
                return response()->json(['message' => 'File upload failed'], 500);
            }
        }

        // Create the event
        $event = Event::create([
            'name' => $request->input('name'),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'img' => $filePath,
        ]);

        return response()->json(['message' => 'Event created successfully']);
    }
}
