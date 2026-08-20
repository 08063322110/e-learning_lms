<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return response()->json([
            'success' => true,
            'data' => $courses
        ]);
    }

    public function show($id)
{
    $course = Course::find($id);

    if (!$course) {
        return response()->json([
            'success' => false,
            'message' => 'Course not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $course
    ]);
}

public function store(Request $request)
{
    $user = $request->user();

    // Only role 1 and role 2 can create courses
    if (!in_array($user->role_id, [1, 2])) {
        return response()->json([
            'success' => false,
            'message' => 'You are not authorized to create a course.'
        ], 403);
    }

    $validated = $request->validate([
        'category_id' => 'required|integer',
        'title' => 'required|string|max:191',
        'sub_title' => 'nullable|string|max:191',
        'description' => 'required|string',
        'about_instructor' => 'nullable|string',
        'playlist_url' => 'required|string|max:191',
        'tags' => 'nullable|string|max:191',
        'photo' => 'nullable|string|max:191',
        'promo_video_url' => 'nullable|string|max:191',
        'creator_status' => 'required|string|max:191',
        'admin_status' => 'required|string|max:191',
        'what_will_students_learn' => 'nullable|string',
        'target_students' => 'nullable|string',
        'requirements' => 'nullable|string',
        'discount_price' => 'required|numeric',
        'actual_price' => 'required|numeric',
    ]);

    $validated['user_id'] = $user->id;
    $validated['view_count'] = 0;
    $validated['subscriber_count'] = 0;
    $validated['photo'] = '';

    $course = Course::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Course created successfully',
        'data' => $course
    ], 201);
}

public function update(Request $request, $id)
{
    // Check if the logged-in user is authorized
    if (!in_array(auth()->user()->role_id, [1, 2])) {
        return response()->json([
            'success' => false,
            'message' => 'You are not authorized to update a course.'
        ], 403);
    }

    // Find the course
    $course = Course::find($id);

    if (!$course) {
        return response()->json([
            'success' => false,
            'message' => 'Course not found.'
        ], 404);
    }

    // Validate the information
    $validated = $request->validate([
        'category_id' => 'required|integer',
        'title' => 'required|string|max:191',
        'sub_title' => 'nullable|string|max:191',
        'description' => 'required|string',
        'about_instructor' => 'nullable|string',
        'playlist_url' => 'required|string|max:191',
        'tags' => 'nullable|string|max:191',
        'photo' => 'nullable|string|max:191',
        'promo_video_url' => 'nullable|string|max:191',
        'creator_status' => 'required|string|max:191',
        'admin_status' => 'required|string|max:191',
        'what_will_students_learn' => 'nullable|string',
        'target_students' => 'nullable|string',
        'requirements' => 'nullable|string',
        'discount_price' => 'required|numeric',
        'actual_price' => 'required|numeric',
    ]);
    
    $validated['photo'] = $validated['photo'] ?? '';

    // Update the course
    $course->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Course updated successfully',
        'data' => $course
    ], 200);
}

public function destroy($id)
{
    $course = Course::find($id);

    if (!$course) {
        return response()->json([
            'message' => 'Course not found'
        ], 404);
    }

    $course->delete();

    return response()->json([
        'message' => 'Course deleted successfully'
    ], 200);
}

}