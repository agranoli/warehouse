<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();

        // Format the users as needed (e.g., return only specific fields)
        $formattedUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ];
        });

        // Return the formatted users as a JSON response
        return response()->json($formattedUsers);
    }
}
