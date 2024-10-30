<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EditEventController extends Controller
{
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'date_from' => 'sometimes|required|date',
            'date_to' => 'sometimes|required|date|after_or_equal:date_from',
            'file' => 'sometimes|file|image|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('images', 'public');
            $validatedData['file'] = $filePath;
        }

        $event->update($validatedData);

        return response()->json(['message' => 'Event updated successfully', 'event' => $event]);
    }
}
