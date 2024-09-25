<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class GetCategoryController extends Controller
{
    /**
     * Get all categories from the database.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            // Fetch all categories
            $categories = Category::all();

            // Return categories as JSON response
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'message' => 'Failed to fetch categories',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
