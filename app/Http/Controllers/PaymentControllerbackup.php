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

    public function handleGatewayCallback(Request $request)
    {
        $reference = $request->reference;
        $secretKey = config('paystack.secretKey');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/". rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer ". $secretKey,
                "Cache-Control: no-cache",
            ],
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);

        if ($result && $result->status && $result->data->status == 'success') {
            $user = auth()->user();
            $courseId = basename($request->reference); // we will get this from reference: CRS1_USR2_...

            // Get course_id from reference CRS1_USR2_1783127741
            $parts = explode('_', $reference);
            $courseId = str_replace('CRS', '', $parts[0]);

            // 1. Save payment
        Payment::updateOrCreate(
    [
        'reference' => $result->data->reference,
    ],
    [
        'user_id'   => Auth::id(),
        'course_id' => $courseId,
        'amount'    => $result->data->amount / 100,
        'status'    => 'success',
    ]
);

            // 2. Enroll user - COMMENT THIS OUT IF YOU DON'T HAVE courses() RELATION
            // $user->courses()->syncWithoutDetaching([$courseId]);

            return redirect('/courses/'.$courseId)->with('success', 'Payment successful and you are enrolled!');
        }

        return redirect('/')->with('error', 'Payment verification failed');
    }

    public function index(Request $request)
    {
        $payments = $this->paymentRepository->all();
        return view('payments.index')->with('payments', $payments);
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();
        $payment = $this->paymentRepository->create($input);
        Flash::success('Payment saved successfully.');
        return redirect(route('payments.index'));
    }

    public function show($id)
    {
        $payment = $this->paymentRepository->find($id);
        if (empty($payment)) {
            Flash::error('Payment not found');
            return redirect(route('payments.index'));
        }
        return view('payments.show')->with('payment', $payment);
    }

    public function edit($id)
    {
        $payment = $this->paymentRepository->find($id);
        if (empty($payment)) {
            Flash::error('Payment not found');
            return redirect(route('payments.index'));
        }
        return view('payments.edit')->with('payment', $payment);
    }

    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->find($id);
        if (empty($payment)) {
            Flash::error('Payment not found');
            return redirect(route('payments.index'));
        }
        $payment = $this->paymentRepository->update($request->all(), $id);
        Flash::success('Payment updated successfully.');
        return redirect(route('payments.index'));
    }

    public function destroy($id)
    {
        $payment = $this->paymentRepository->find($id);
        if (empty($payment)) {
            Flash::error('Payment not found');
            return redirect(route('payments.index'));
        }
        $this->paymentRepository->delete($id);
        Flash::success('Payment deleted successfully.');
        return redirect(route('payments.index'));
    }
}