<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class GetEventController extends Controller
{
    public function index()
    {
        // Retrieve all events
        $events = Event::all();

        // Return the events as a JSON response
        return response()->json($events);
    }

    public function show($id)
    {
        // Retrieve the event by ID
        $event = Event::find($id);

        // Check if the event exists
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Return the event as a JSON response
        return response()->json($event);
    }
}
