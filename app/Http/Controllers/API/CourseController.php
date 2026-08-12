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
}