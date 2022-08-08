<?php

namespace App\Http\Controllers\User;
use App\Utilities\{Autofications, Balance};
use App\Http\Controllers\Controller;
use App\Models\{Number, Country, Website};
use Exception;
use Validator;

class NumbersController extends Controller
{

    //
    public function index()
    {
        return view('user.numbers.index', ['title' => 'My Numbers | Legitsms']);
    }

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
            Balance::save($price, $debit = true);
            // $autofications = Autofications::GeneratePhoneNumber(['website' => $website->code, 'country_code' => strtoupper($country->iso2)]);
            $autofications = true;
            if (empty($autofications)) {
                Balance::save($price, $debit = false); //Credit back user balnce if transaction fails.
                return response()->json([
                    'status' => 0,
                    'info' => 'Generating number failed. Try again.'
                ]);
            }

            $generate = Number::create([
                'website_id' => $website->id,
                'country_id' => $country->id,
                'user_id' => auth()->id(),
                'phone' => 123,
                'responded' => true,
                'status' => 'done'
            ]);

            return $generate->id > 0 ? response()->json([
                'status' => 1,
                'info' => 'Number generated successfully.',
                'redirect' => '',
            ]) : response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);
        } catch (Exception $exception) {
            Balance::save($price, $debit = false); //Credit back user balnce if transaction fails.
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $exception->getMessage() : 'Unknown error. Try again later.'
            ]);
        }
            
    }
}
