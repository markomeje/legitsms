<?php

namespace App\Http\Controllers\User;
use App\Utilities\Paystack;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Deposit;
use Exception;
use Validator;

class DepositController extends Controller
{
    //
    public function deposit()
    {
        $data = request()->all(['amount']);
        $validator = Validator::make($data, [ 
            'amount' => ['required', 'integer', 'min:1000'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $amount = (int)$data['amount'] ?? 0;
        if($amount < 1000) {
            return response()->json([
                'status' => 0,
                'info' => 'Minimum of NGN1,000 is required'
            ]);
        }

        try {
            $reference = Str::uuid();
            $deposit = Deposit::create([
                'amount' => $amount,
                'user_id' => auth()->id(),
                'reference' => $reference,
                'deposited' => false,
                'status' => 'initialized'
            ]);

            if ($deposit->id > 0) {
                $paystack = (new Paystack())->initialize(['amount' => $amount, 'email' => auth()->user()->email, 'reference' => $reference]);
                return (is_object($paystack) && isset($paystack->data)) ? response()->json([
                    'status' => 1,
                    'info' => 'Redirecting to payment. Please wait . . .',
                    'redirect' => $paystack->data->authorization_url,
                ]) : throw new Exception('Error processing request');
            }

            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later.'
            ]);
        }
            
    }
}
