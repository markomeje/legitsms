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
            $response = Http::timeout(self::$timeout)->get(env('AUTOFICATIONS_BASE_URL'), ['action' => 'generate', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $website->code, 'country' => $website->country->id_number]);
            
            if ($response->failed()) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.'
                ]);
            }

            $response = $response->body();
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
                    'response' => $response,
                ]);
            }

            $generate = Verification::create([
                'website_id' => $website->id,
                'country_id' => $website->country->id,
                'user_id' => auth()->id(),
                'phone' => $response,
                'code' => null,
                'status' => 'pending',
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

        $code = $verification->code ?? '';
        $status = $verification->status ?? '';
        if($status === 'done') {
            return response()->json([
                'status' => 1,
                'info' => 'Verification done.',
                'code' => $verification->code,
            ]);
        } 

        $account = auth()->user()->account;
        if (empty($account)) {
            return response()->json([
                'status' => -1,
                'info' => 'Insufficient funds'
            ]);
        }

        $price = (int)$verification->website->price;
        if ((int)$account->balance < $price) {
            return response()->json([
                'status' => -1,
                'info' => 'Insufficient funds.'
            ]);
        }

        $tenMinutesPassed = Carbon::parse($verification->created_at)->diffInSeconds(Carbon::now()) > (60 * 10);
        if($tenMinutesPassed) {
            $verification->code = empty($verification->code) ? 'Verification expired.' : $verification->code;
            $verification->status = 'expired';
            $verification->update();

            return response()->json([
                'status' => -1,
                'info' => 'Verification expired.',
                'verification' => $verification
            ]);
        }
            
        try {
            $params = ['action' => 'read', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $verification->website->code, 'country' => $verification->country->id_number, 'phone_number' => $verification->phone];
            $response = Http::timeout(self::$timeout)->get('https://autofications.com/V2/API.php', $params);
            
            if ($response->failed()) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Reading SMS failed.',
                ]);
            }

            $response = $response->body();
            if ($response == 'Not_received') {
                return response()->json([
                    'status' => 0,
                    'info' => 'Awaiting code . . .',
                ]);
            }

            if (isset(Autofications::$errors[$response])){
                $verification->code = $response;
                $verification->status = 'done';
                $verification->update();

                return response()->json([
                    'status' => -1,
                    'info' => $response,
                ]);
            }

            for ($i = 0; $i < 10; $i++) { 
                if (str_contains($response, $i)) {
                    Balance::save($price, $debit = true); //Debit user
                    $verification->code = $response;
                    $verification->status = 'done';
                    $verification->update();

                    return response()->json([
                        'status' => 1,
                        'code' => $response,
                    ]);
                }

                $verification->code = $response;
                $verification->status = 'done';
                $verification->update();

                return response()->json([
                    'status' => 1,
                    'info' => $response,
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.',
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

            $verification->delete();
            return response()->json([
                'status' => 1,
                'info' => $response->body(),
                'redirect' => route('home'),
            ]);

        } catch (Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $exception->getMessage() : 'Unknown error. Try again later.'
            ]);   
        }
    }
}
