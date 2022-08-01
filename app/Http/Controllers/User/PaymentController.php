<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Exception;

/**
 * 
 */
class PaymentController extends Controller
{

	public function pay()
	{
		$data = request()->all(['amount', 'type']);
		$validator = Validator::make($data, [ 
            'amount' => ['required', 'integer'],  
            'type' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }


		try {
			$reference = Str::uuid();
        	$amount = $data['amount'];
			$paystack = (new Paystack())->initialize([
	            'amount' => $amount,
	            'email' => auth()->user()->email, 
	            'reference' => $reference,
	            'currency' => 'NGN',
	            'callback_url' => route('user.payment.verify'),
	        ]);

			if ($paystack) {
				Payment::create([
					'reference' => $reference,
					'type' => $data['type'],
					'amount' => $amount,
					'user_id' => auth()->id(),
					'status' => 'initialized',
					'paid' => false,
				]);

                return response()->json([
                    'status' => 1, 
                    'info' => 'Please wait . . .',
                    'redirect' => $paystack->data->authorization_url,
                ]);
            }
            
            return response()->json([
                'status' => 0, 
                'info' => 'Payment initialization failed. Try again.',
            ]);
			
		} catch (Exception $e) {
			return response()->json([
                'status' => 0, 
                'info' => 'Network error. Refresh the page and try again.'
            ]);
		}
			
	}
}