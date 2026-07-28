<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Payment;
use App\Models\Course; // <-- ADDED THIS
use Illuminate\Support\Facades\Auth;

class PaymentController extends AppBaseController
{
    /** @var PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }

    public function redirectToGateway(Request $request)
    {
        if(empty($request->amount) || $request->amount == 0){
            return redirect()->back()->with('error', 'Amount is 0');
        }

        $secretKey = config('paystack.secretKey');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'email' => $request->email,
                'amount' => $request->amount,
                'reference' => $request->reference,
                'metadata' => json_decode($request->metadata, true), // <-- ADDED THIS LINE
                'callback_url' => route('paymentCallback'),
            ]),
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer ". $secretKey,
                "Content-Type: application/json",
            ],
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $response = curl_exec($curl);
        $responseData = json_decode($response);
        curl_close($curl);

        if($responseData && $responseData->status){
            return redirect($responseData->data->authorization_url);
        }

        return redirect()->back()->with('error', 'Could not connect to Paystack');
    }

    public function handleGatewayCallback(Request $request) // <-- ADDED Request $request
    {
        $reference = $request->reference; // Paystack sends reference back
        $secretKey = config('paystack.secretKey');

        // Verify with cURL
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer ". $secretKey,
                "Cache-Control: no-cache",
            ],
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $response = curl_exec($curl);
        $responseData = json_decode($response);
        curl_close($curl);

        if($responseData && $responseData->status == true && $responseData->data->status == 'success')
        {
            $course_id = $responseData->data->metadata->course_id; // <-- Get from metadata
            $user_id = Auth::id();

            // 1. Save payment to DB
            Payment::firstOrCreate( // firstOrCreate prevents duplicate payments
                ['reference' => $reference],
                [
                    'user_id' => $user_id,
                    'course_id' => $course_id,
                    'amount' => $responseData->data->amount / 100,
                    'status' => 'success'
                ]
            );
// 2. Enroll user to course with correct paid_amount
$course = Course::find($course_id);
$finalPrice = $responseData->data->amount / 100; // Paystack returns in kobo, so divide by 100

if($course && !$course->users()->where('user_id', $user_id)->exists()){
    $course->users()->attach($user_id, [
        'paid_amount' => $finalPrice,
        'paid_date' => now(),
        'expiry_date' => now()->addYear(), // change this if your course has different duration
        'plan' => 'full',
        'status' => 'active'
    ]); 
}

session()->flash('success', 'Payment successful! You are now enrolled in this course.');
return redirect()->route('courses.show', $course_id);
        }
        else
        {
            Flash::error('Payment failed. Please try again.');
            return redirect()->route('courses.index');
        }
    }
    // ... rest of your CRUD functions stay the same
}