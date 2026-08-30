<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use Illuminate\Http\Request;

class CourseUserController extends Controller
{
    public function index()
    {
        $courseUsers = CourseUser::with(['user', 'course'])->get();

        return response()->json([
            'success' => true,
            'data' => $courseUsers
        ]);
    }

    public function show($id)
    {
        $courseUser = CourseUser::with(['user', 'course'])->find($id);

        if (!$courseUser) {
            return response()->json([
                'success' => false,
                'message' => 'Course enrollment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $courseUser
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id',
            'user_account_id' => 'nullable|integer',
            'paid_date' => 'required|date',
            'expiry_date' => 'required|date',
            'plan' => 'nullable|string|max:191',
            'paid_amount' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        $courseUser = CourseUser::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Course enrollment created successfully',
            'data' => $courseUser
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $courseUser = CourseUser::find($id);

        if (!$courseUser) {
            return response()->json([
                'success' => false,
                'message' => 'Course enrollment not found'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id',
            'user_account_id' => 'nullable|integer',
            'paid_date' => 'required|date',
            'expiry_date' => 'required|date',
            'plan' => 'nullable|string|max:191',
            'paid_amount' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        $courseUser->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Course enrollment updated successfully',
            'data' => $courseUser
        ]);
    }

    public function destroy($id)
    {
        $courseUser = CourseUser::find($id);

        if (!$courseUser) {
            return response()->json([
                'success' => false,
                'message' => 'Course enrollment not found'
            ], 404);
        }

        $courseUser->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course enrollment deleted successfully'
        ]);
    }
}