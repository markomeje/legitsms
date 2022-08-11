<?php

namespace App\Http\Controllers\User;
use App\Utilities\{Autofications, Balance};
use App\Http\Controllers\Controller;
use App\Models\{Country, Website, Verification};
use Illuminate\Support\Str;
use Exception;
use Validator;

class VerificationController extends Controller
{

    //
    public function process()
    {
        $data = request()->all(['website_id', 'country_id']);
        $country = Country::find($data['country_id']);
        $website = Website::find($data['website_id']);
        if (empty($country) || empty($website)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation. Try again.'
            ]);
        }

        $account = auth()->user()->account;
        if (empty($account)) {
            return response()->json([
                'status' => 0,
                'info' => 'Please fund your account and try again.'
            ]);
        }

        $price = (int)$website->price;
        if ((int)$account->balance < $price) {
            return response()->json([
                'status' => 0,
                'info' => 'Insufficient funds.'
            ]);
        }

        try {
            Balance::save($price, $debit = true);
            $autofications = Autofications::GeneratePhoneNumber(['website' => $website->code, 'country_code' => strtoupper($country->iso2)]);
            // $autofications = ['response' => ['09098787656'], 'status' => 1];
            if ($autofications['status'] !== 1 || empty($autofications['response'])) {
                Balance::save($price, $debit = false); //Credit back user balnce
                return response()->json([
                    'status' => 0,
                    'info' => 'Generating number failed. Try again.'
                ]);
            }

            $phone = $autofications['response'][0] ?? null;
            if (empty($phone)) {
                Balance::save($price, $debit = false); //Credit back user balnce
                return response()->json([
                    'status' => 0,
                    'info' => 'Generating number failed. Try again.'
                ]);
            }

            $generate = Verification::create([
                'website_id' => $website->id,
                'country_id' => $country->id,
                'user_id' => auth()->id(),
                'phone' => $phone,
                'code' => null,
                'status' => 'done',
            ]);

            return $generate->id > 0 ? response()->json([
                'status' => 1,
                'info' => 'Number generated successfully.',
                'redirect' => route('phone.generated', ['id' => $generate->id]),
            ]) : response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);
        } catch (Exception $exception) {
            Balance::save($price, $debit = false); //Credit back user balnce
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $exception->getMessage() : 'Unknown error. Try again later.'
            ]);
        }    
    }

    //
    public function read()
    {
        $id = request()->get('id');
        if (empty($id)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation. Try again.'
            ]);
        }

        $verification = Verification::find($id);
        if (empty($verification)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation. Try again.'
            ]);
        }

        try {
            $autofications = Autofications::ReadSms(['website' => $verification->website->code, 'country_code' => strtoupper($verification->country->iso2), 'phone_number' => $verification->phone]);
            // dd($autofications);
            // $autofications = ['response' => ['09098787656'], 'status' => 1];
            if ($autofications['status'] !== 1 || empty($autofications['response'])) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Reading sms timeout. Try again.'
                ]);
            }

            $code = $autofications['response'][0] ?? null;
            if (empty($code)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation timeout. Try again.'
                ]);
            }

            $verification->code = $code;
            $verification->status = 'done';

            return $verification->update() ? response()->json([
                'status' => 1,
                'info' => 'Code recieved.',
                'redirect' => '',
            ]) : response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $exception->getMessage() : 'Unknown error. Try again later.'
            ]);
        }    
    }
}
