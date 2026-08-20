<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get all categories
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    // Get one category
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    // Create category
    public function store(Request $request)
    {
        $user = $request->user();

        // Only role 1 and role 2 can create categories
        if (!in_array($user->role_id, [1, 2])) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to create a category.'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string'
        ]);

        // New categories start with zero views
        $validated['view_count'] = 0;

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    // Update category
    public function update(Request $request, $id)
    {
        $user = $request->user();

        if (!in_array($user->role_id, [1, 2])) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update a category.'
            ], 403);
        }

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    // Delete category
    public function destroy($id)
    {
        $user = auth()->user();

        if (!in_array($user->role_id, [1, 2])) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete a category.'
            ], 403);
        }

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}