<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function promote($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role; // "user" or "admin"
        $user->approved_at = now();
        $user->save();

        return response()->json(['message' => 'User promoted.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted.']);
    }

}
