<?php

namespace App\Http\Controllers\User;
use App\Utilities\{Autofications, Balance};
use App\Http\Controllers\Controller;
use App\Models\{Country, Website, Verification};
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Validator;

class VerificationController extends Controller
{

    /**
     * API Request timeout
     * 300 seconds or 5Minutes
     */
    public static $timeout = 300;

    //
    public function process()
    {
        $data = request()->all(['website_id']);
        $website = Website::find($data['website_id']);
        if (empty($website)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation. Try again.'
            ]);
        }

        if (empty($website->country)) {
            return response()->json([
                'status' => 0,
                'info' => 'This website ID is not supported'
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
            $http = Http::timeout(self::$timeout)->get(env('AUTOFICATIONS_BASE_URL'), ['action' => 'generate', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $website->code, 'country' => $website->country->id_number]);
            
            if ($http->failed()) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.'
                ]);
            }

            $response = $http->json();
            if (isset(Autofications::$errors[$response])) {
                return response()->json([
                    'status' => 0,
                    'info' => Autofications::$errors[$response]
                ]);
            }

            if (empty($response)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Autofications returned empty response. Try again.',
                    'response' => [$http],
                ]);
            }

            $generate = Verification::create([
                'website_id' => $website->id,
                'country_id' => $website->country->id,
                'user_id' => auth()->id(),
                'phone' => $response,
                'code' => null,
                'status' => 'done',
            ]);

            return $generate->id > 0 ? response()->json([
                'status' => 1,
                'info' => 'Number generated successfully.',
                'redirect' => route('home.verifications', ['id' => $generate->id]),
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

        $account = auth()->user()->account;
        if (empty($account)) {
            return response()->json([
                'status' => 0,
                'info' => 'Insufficient funds'
            ]);
        }

        $price = (int)$verification->website->price;
        if ((int)$account->balance < $price) {
            return response()->json([
                'status' => 0,
                'info' => 'Insufficient funds.'
            ]);
        }

        if(Carbon::parse($verification->created_at)->diffInSeconds(Carbon::now()) > (60 * 25)) {
            if(empty($verification->code)){

                $verification->code = 'This verification has expired.';
                $verification->status = 'done';
                $verification->update();

                return response()->json([
                    'status' => 1,
                    'info' => 'Operation expired.',
                    'response' => 'Verification expired',
                ]);

            }
        }

        if(!empty($verification->code)) {
            response()->json([
                'status' => 1,
                'info' => 'Verification already recieved.',
                'response' => $verification->code,
            ]);
        } 
            
        try {
            $params = ['action' => 'read', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $verification->website->code, 'country' => $verification->country->id_number, 'phone_number' => $verification->phone];
            $response = Http::timeout(self::$timeout)->get('https://autofications.com/V2/API.php', $params);
            
            if ($response->failed()) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Reading SMS failed. Try again later.'
                ]);
            }

            $response = $response->json();
            if (isset(Autofications::$errors[$response])) {
                $verification->code = $response;
                $verification->status = 'done';
                $verification->update();

                response()->json([
                    'status' => 0,
                    'info' => 'System Error. Try again later',
                    'response' => $response,
                ]);
            }

            if (empty($response)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Awaiting code . . .',
                ]);
            }

            $verification->code = $response;
            $verification->status = 'done';

            if($verification->update()) {
                Balance::save($price, $debit = true); //Debit user
                response()->json([
                    'status' => 1,
                    'info' => 'Code recieved.',
                    'response' => $response,
                    'redirect' => '',
                ]);
            } 

            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.',
                'response' => 'Unknown Error'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $exception->getMessage() : 'Unknown error. Try again later.'
            ]);
        }    
    }

    //
    public function blacklist()
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
            $params = ['action' => 'blacklist', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $verification->website->code, 'country' => $verification->country->id_number, 'phone_number' => $verification->phone];

            $response = Http::timeout(self::$timeout)->get(env('AUTOFICATIONS_BASE_URL'), $params);
            
            if ($response->failed()) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            $response = $response->json();
            if('Success' == $response || empty($response)) {
                $verification->delete();
                return response()->json([
                    'status' => 1,
                    'info' => 'Number blacklisted.',
                    'redirect' => '',
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Operation failed.',
            ]);

        } catch (Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $exception->getMessage() : 'Unknown error. Try again later.'
            ]);   
        }
    }
}
