<?php

namespace App\Http\Controllers\User;
use App\Utilities\Autofications;
use App\Http\Controllers\Controller;
use App\Models\{Number, Country, Website};
use Exception;
use Validator;

class NumbersController extends Controller
{
    //
    public function generate()
    {
        $data = request()->all(['website', 'country']);
        $validator = Validator::make($data, [ 
            'website' => ['required', 'integer'],  
            'country' => ['required', 'integer'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $country = Country::find($data['country']);
        $website = Website::find($data['website']);
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
            $generate = Number::create([
                'website_id' => $website->id,
                'country_id' => $country->id,
                'user_id' => auth()->id(),
                'phone' => null,
                'responded' => false,
                'status' => 'initialized'
            ]);
            dd($generate);

            $autofications = Autofications::generate(['website' => $website->code, 'country' => strtoupper($country->iso2)]);
            if (empty($autofications)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Generating number failed. Try again.'
                ]);
            }

            $phone = $autofications;
            $generate->phone = $phone;
            $generate->responded = true;
            $generate->status = 'done';
            return $generate->update() ? response()->json([
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
                'info' => 'Unknown error. Try again later.'
            ]);
        }
            
    }
}
