<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use App\Models\Payment;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class PaymentController extends AppBaseController
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }


    /*
    |--------------------------------------------------------------------------
    | Payment CRUD
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $payments = Payment::latest()->paginate(10);

        return view('payments.index')
            ->with('payments', $payments);
    }


    public function create()
    {
        return view('payments.create');
    }


    public function store(CreatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->create($request->all());

        Flash::success('Payment saved successfully.');

        return redirect(route('payments.index'));
    }


    public function show($id)
    {
        $payment = $this->paymentRepository->find($id);

        if(empty($payment)){
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.show')
            ->with('payment',$payment);
    }


    public function edit($id)
    {
        $payment = $this->paymentRepository->find($id);

        if(empty($payment)){
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.edit')
            ->with('payment',$payment);
    }


    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->find($id);

        if(empty($payment)){
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->update(
            $request->all(),
            $id
        );

        Flash::success('Payment updated successfully.');

        return redirect(route('payments.index'));
    }


    public function destroy($id)
    {
        $payment = $this->paymentRepository->find($id);

        if(empty($payment)){
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->delete($id);

        Flash::success('Payment deleted successfully.');

        return redirect(route('payments.index'));
    }



    /*
    |--------------------------------------------------------------------------
    | Paystack Payment
    |--------------------------------------------------------------------------
    */


    public function redirectToGateway(Request $request)
    {

        $secretKey = config('paystack.secretKey');


        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL =>
            "https://api.paystack.co/transaction/initialize",

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => json_encode([

                'email' => $request->email,

                'amount' => $request->amount * 100,

                'reference' => $request->reference,

                'metadata'=>[
                    'course_id'=>$request->course_id,
                    'user_id'=>Auth::id()
                ],

                'callback_url'=>route('paymentCallback')

            ]),


            CURLOPT_HTTPHEADER => [

                "Authorization: Bearer ".$secretKey,

                "Content-Type: application/json"

            ],


            CURLOPT_SSL_VERIFYPEER=>false

        ]);



        $response = curl_exec($curl);

        curl_close($curl);



        $result=json_decode($response);



        if($result && $result->status){

            return redirect(
                $result->data->authorization_url
            );

        }


        return back()
        ->with('error','Unable to connect to Paystack');

    }





    public function handleGatewayCallback(Request $request)
    {

        $reference=$request->reference;


        $secretKey=config('paystack.secretKey');


        $curl=curl_init();


        curl_setopt_array($curl,[


            CURLOPT_URL =>
            "https://api.paystack.co/transaction/verify/".$reference,


            CURLOPT_RETURNTRANSFER=>true,


            CURLOPT_HTTPHEADER=>[

                "Authorization: Bearer ".$secretKey,

                "Cache-Control:no-cache"

            ],


            CURLOPT_SSL_VERIFYPEER=>false

        ]);



        $response=curl_exec($curl);

        curl_close($curl);



        $result=json_decode($response);



        if(
            $result &&
            $result->status &&
            $result->data->status=="success"
        ){


            $course_id =
            $result->data->metadata->course_id;


            $user_id =
            Auth::id();



            /*
            Save payment
            */

          /*
Save payment
*/
Payment::firstOrCreate(

    [
        'reference'=>$reference
    ],

    [

        'user_id'=>$user_id,

        'course_id'=>$course_id,

        'amount'=>$result->data->amount/100,

        'status'=>'success',

        'payment_processor'=>'Paystack',

        'mode_of_payment'=>$result->data->channel ?? 'Unknown'

    ]

);
            /*
            Enroll student
            */


            $course=Course::find($course_id);



            if($course){

                $course->users()
                ->syncWithoutDetaching([

                    $user_id=>[

                        'user_account_id'=>$user_id,

                        'paid_amount'=>
                        $result->data->amount/100,

                        'paid_date'=>now(),

                        'expiry_date'=>
                        now()->addYear(),

                        'plan'=>'full',

                        'status'=>1

                    ]

                ]);

            }



            Flash::success(
                'Payment successful. You are enrolled.'
            );


            return redirect()
            ->route('courses.show',$course_id);


        }



        Flash::error(
            'Payment verification failed'
        );


        return redirect()
        ->route('courses.index');


    }

}