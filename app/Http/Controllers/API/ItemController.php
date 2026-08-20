<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of all Items.
     */
    
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'success' => true,
            'data' => $items
        ]);
    }

    /**
     * Display one Item.
     */
    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $item
        ]);
    }

    /**
     * Create a new Item.
     */

    public function store(Request $request)
    {
        $user = $request->user();

        // Only role 1 and role 2 can create course content
        if (!in_array($user->role_id, [1, 2])) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to create an item.'
            ], 403);
        }

        $validated = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'title' => 'required|string|max:191',
            'url' => 'nullable|string|max:191',
            'description' => 'nullable|string'
        ]);

        // Automatically assign the logged-in user
        $validated['user_id'] = $user->id;

        // New item starts with zero views
        $validated['view_count'] = 0;

        $item = Item::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item created successfully',
            'data' => $item
        ], 201);
    }

    /**
     * Update an existing Item.
     */

    public function update(Request $request, $id)
    {
        $user = $request->user();

        // Only role 1 and role 2 can update course content
        if (!in_array($user->role_id, [1, 2])) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update an item.'
            ], 403);
        }

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }

        $validated = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'title' => 'required|string|max:191',
            'url' => 'nullable|string|max:191',
            'description' => 'nullable|string'
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully',
            'data' => $item
        ], 200);
    }

    /**
     * Delete an Item.
     */

    public function destroy($id)
    {
        $user = auth()->user();

        // Only role 1 and role 2 can delete course content
        if (!in_array($user->role_id, [1, 2])) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete an item.'
            ], 403);
        }

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully'
        ], 200);
    }
}