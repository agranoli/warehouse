<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class NewEventController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'nosaukums' => 'required|string|max:255',
            'datums_no' => 'required|date',
            'datums_lidz' => 'required|date|after_or_equal:datums_no',
            'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'users' => 'required|array',  // Array of user IDs
            'users.*' => 'exists:users,id',  // Ensure user IDs exist in the users table
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('event_files', 'public');
        }

        // Create the event
        $event = Event::create([
            'nosaukums' => $request->input('nosaukums'),
            'datums_no' => $request->input('datums_no'),
            'datums_lidz' => $request->input('datums_lidz'),
            'file' => $filePath,
        ]);

        // Attach selected users to the event
        $event->users()->attach($request->input('users'));

        return response()->json(['message' => 'Event created successfully']);
    }
}
