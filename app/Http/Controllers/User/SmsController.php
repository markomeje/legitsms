<?php

namespace App\Http\Controllers\User;
use App\Utilities\{Autofications, Balance};
use App\Http\Controllers\Controller;
use App\Models\{Number, Country, Sms};
use Exception;
use Validator;

class SmsController extends Controller
{

    //
    public function index()
    {
        return view('user.sms.index', ['title' => 'My Sms | Legitsms']);
    }

    //
    public function read()
    {
        $data = request()->all();
        $validator = Validator::make($data, [   
            'phone' => ['required', 'integer'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $number_id = $data['phone'] ?? null;
        $number = Number::find($data['phone']);
        if (empty($number)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation. Try again.'
            ]);
        }

        try {
            // $autofications = Autofications::ReadSms(['website' => $website->code, 'country_code' => strtoupper($country->iso2), 'phone_number' => $number->phone]);
            $autofications = true;
            if (empty($autofications)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Generating number failed. Try again.'
                ]);
            }

            $sms = Sms::create([
                'website_id' => $number->website->id,
                'country_id' => $number->country->id,
                'user_id' => auth()->id(),
                // 'message' => $autofications,
                'message' => rand(290631, 856140),
                'number_id' => $number->id,
                'received' => true,
                'status' => 'done'
            ]);

            return $sms->id > 0 ? response()->json([
                'status' => 1,
                'info' => 'Number generated successfully.',
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
