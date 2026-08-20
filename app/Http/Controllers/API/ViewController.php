<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Get all views
     */
    public function index()
    {
        $views = View::all();

        return response()->json([
            'success' => true,
            'data' => $views
        ]);
    }

    /**
     * Get one view
     */
    public function show($id)
    {
        $view = View::find($id);

        if (!$view) {
            return response()->json([
                'success' => false,
                'message' => 'View not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $view
        ]);
    }

    /**
     * Create a view
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_account_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'course_id' => 'nullable|integer',
            'item_id' => 'nullable|integer',
        ]);

        $view = new View();

        $view->user_id = auth()->id();
        $view->user_account_id = $request->user_account_id;
        $view->category_id = $request->category_id;
        $view->course_id = $request->course_id;
        $view->item_id = $request->item_id;

        $view->save();

        return response()->json([
            'success' => true,
            'message' => 'View created successfully',
            'data' => $view
        ], 201);
    }

    /**
     * Update a view
     */
    public function update(Request $request, $id)
    {
        $view = View::find($id);

        if (!$view) {
            return response()->json([
                'success' => false,
                'message' => 'View not found'
            ], 404);
        }

        $request->validate([
            'user_account_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'course_id' => 'nullable|integer',
            'item_id' => 'nullable|integer',
        ]);

        $view->user_account_id = $request->user_account_id;
        $view->category_id = $request->category_id;
        $view->course_id = $request->course_id;
        $view->item_id = $request->item_id;

        $view->save();

        return response()->json([
            'success' => true,
            'message' => 'View updated successfully',
            'data' => $view
        ]);
    }

    /**
     * Delete a view
     */
    public function destroy($id)
    {
        $view = View::find($id);

        if (!$view) {
            return response()->json([
                'success' => false,
                'message' => 'View not found'
            ], 404);
        }

        $view->delete();

        return response()->json([
            'success' => true,
            'message' => 'View deleted successfully'
        ]);
    }
}