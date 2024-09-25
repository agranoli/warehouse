<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class NewCategoryController extends Controller
{
    /**
     * Store a new category in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        try {
            // Create a new category
            $category = Category::create([
                'name' => $validated['name'],
            ]);

            // Return a success response
            return response()->json([
                'message' => 'Category created successfully',
                'category' => $category,
            ], 201);

        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'message' => 'Failed to create category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
