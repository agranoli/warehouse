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
            'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);

        // Handle file uploads
        $filePath = $request->hasFile('file') ? $request->file('file')->store('event_files', 'public') : null;
        $imgPath = $request->hasFile('img') ? $request->file('img')->store('event_images', 'public') : null;

        // Create the event
        $event = Event::create([
            'name' => $request->input('name'),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'file' => $filePath,
            'img' => $imgPath,
        ]);

        // Attach selected users to the event
        $event->users()->attach($request->input('users'));

        return response()->json(['message' => 'Event created successfully']);
    }
}
