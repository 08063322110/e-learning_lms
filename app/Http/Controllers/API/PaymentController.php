<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display all payments.
     */
    public function index()
    {
        $payments = Payment::all();

        return response()->json([
            'success' => true,
            'data' => $payments
        ]);
    }

    /**
     * Display a specific payment.
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $payment
        ]);
    }

    /**
     * Store a new payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string|max:191|unique:payments,reference',
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'course_id' => 'nullable|integer|exists:courses,id',
            'amount' => 'required|numeric',
            'status' => 'required|string|max:191',
            'gateway_response' => 'nullable|string',
            'mode_of_payment' => 'nullable|string|max:191',
            'payment_processor' => 'nullable|string|max:191'
        ]);

        $payment = Payment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Payment created successfully',
            'data' => $payment
        ], 201);
    }

    /**
     * Update a payment.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $validated = $request->validate([
            'reference' => 'required|string|max:191|unique:payments,reference,' . $id,
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'course_id' => 'nullable|integer|exists:courses,id',
            'amount' => 'required|numeric',
            'status' => 'required|string|max:191',
            'gateway_response' => 'nullable|string',
            'mode_of_payment' => 'nullable|string|max:191',
            'payment_processor' => 'nullable|string|max:191'
        ]);

        $payment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Payment updated successfully',
            'data' => $payment
        ]);
    }

    /**
     * Delete a payment.
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment deleted successfully'
        ]);
    }
}