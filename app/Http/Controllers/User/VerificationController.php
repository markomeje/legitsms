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
            $autofications = Autofications::GeneratePhoneNumber(['website' => $website->code, 'country_code' => strtoupper($country->id_number)]);
            // $autofications = ['response' => ['09098787656'], 'status' => 1];
            if ($autofications['status'] !== 1 || empty($autofications['response'])) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Generating number failed. Try again.'
                ]);
            }

            $phone = $autofications['response'] ?? null;
            if (empty($phone)) {
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

        $price = (int)$verification->website->price;
        if (!empty($verification->code)) {
            return response()->json([
                'status' => 1,
                'info' => 'Operation Successful.',
                'code' => $verification->code,
            ]);
        }
            
        try {
            $action = request()->get('action');
            if('blacklist' == $action) {
                $autofications = Autofications::Blacklist(['website' => $verification->website->code, 'country_code' => strtoupper($verification->country->id_number), 'phone_number' => $verification->phone]);

                if ($autofications['status'] !== 1) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Operation failed. Try again.',
                        'autofications' => $autofications,
                    ]);
                }

                $code = $autofications['response'] ?? 'Code empty';
                $verification->code = $code;
                $verification->status = 'done';

                if($verification->update()) {
                    response()->json([
                        'status' => 1,
                        'info' => 'Code recieved.',
                        'code' => $code,
                        'redirect' => '',
                    ]);
                }
            }else {
                $autofications = Autofications::ReadSms(['website' => $verification->website->code, 'country_code' => strtoupper($verification->country->id_number), 'phone_number' => $verification->phone]);

                if ($autofications['status'] !== 1) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Verification failed. Try again.',
                        'autofications' => $autofications,
                    ]);
                }

                $code = $autofications['response'] ?? null;
                if (empty($code)) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Waiting code . . .',
                        'autofications' => $autofications,
                    ]);
                }

                $verification->code = $code;
                $verification->status = 'done';

                if($verification->update()) {
                    Balance::save($price, $debit = true); //Debit user
                    response()->json([
                        'status' => 1,
                        'info' => 'Code recieved.',
                        'code' => $code,
                        'redirect' => '',
                    ]);
                } 
            }

            return response()->json([
                'status' => 0,
                'info' => 'Operation override. Try again.'
            ]);
        } catch (Exception $exception) {
            Balance::save($price, $debit = false); //Credit back user balance incase
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $exception->getMessage() : 'Unknown error. Try again later.'
            ]);
        }    
    }
}
