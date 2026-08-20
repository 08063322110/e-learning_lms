<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Get all comments
     */
    public function index()
    {
        $comments = Comment::all();

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }

    /**
     * Get one comment
     */
    public function show($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $comment
        ]);
    }

    /**
     * Create a comment
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'body' => 'required|string',
        ]);

        $comment = new Comment();

        $comment->user_id = auth()->id();
        $comment->course_id = $request->course_id;
        $comment->category_id = $request->category_id;
        $comment->body = $request->body;

        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Comment created successfully',
            'data' => $comment
        ], 201);
    }

    /**
     * Update a comment
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found'
            ], 404);
        }

        $request->validate([
            'course_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'body' => 'required|string',
        ]);

        $comment->course_id = $request->course_id;
        $comment->category_id = $request->category_id;
        $comment->body = $request->body;

        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Comment updated successfully',
            'data' => $comment
        ]);
    }

    /**
     * Delete a comment
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found'
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully'
        ]);
    }
}