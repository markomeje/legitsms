<?php 

namespace App\Utilities;
use Illuminate\Support\Facades\Http;

/**
 * Autofications API Facade
 */
class Autofications
{

	/**
     * API Request timeout
     * 180 seconds or 3Minutes
     */
    public static $timeout = 180;
    
    /**
     * API errors
     */
    public static $errors = [
        'Balance_error' => 'You do not have enough balance for the verification. Please deposit.',
        'Request_limited' => 'You are requesting the received SMS too quickly. Please only request the SMS once every 20 seconds',
        'Not_received' => 'We have not yet received the SMS to this number',
        'Website_error' => 'This website ID is not supported',
        'Number_error' => 'This phone number is not associated with your request',
        'Number_zero' => 'There are currently no numbers available for this website',
    ];

	/**
	 * Generate phone number
	 */
	public static function GeneratePhoneNumber($data = []) : array
	{
		try {
			$params = ['action' => 'generate', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $data['website'], 'country' => $data['country_code']];

            $response = Http::timeout(self::$timeout)->get(env('AUTOFICATIONS_BASE_URL'), $params);
            if ($response->failed()) {
                return [
                    'status' => 0,
                    'info' => 'Phone number generation failed. Try again later.'
                ];
            }

            return [
                'status' => 1,
                'response' => $response->json(),
                'info' => 'Phone number generation successful.'
            ];
        } catch (Exception $error) {
            return [
                'status' => 0,
                'info' => 'Network Error. Try Again.'
            ];
        }
	}

    /**
     * Generate phone number
     */
    public static function ReadSms($data = []) : array
    {
        try {
            $params = ['action' => 'read', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $data['website'], 'country' => $data['country_code'], 'phone_number' => $data['phone_number']];

            $response = Http::timeout(self::$timeout)->get('https://autofications.com/V2/API.php', $params);
            if ($response->failed()) {
                return [
                    'status' => 0,
                    'info' => 'Reading Sms Failed. Try Again Later.'
                ];
            }

            return [
                'status' => 1,
                'response' => $response->json(),
                'info' => 'Reading sms passed.'
            ];
        } catch (Exception $error) {
            return [
                'status' => 0,
                'info' => 'Network Error. Try Again.'
            ];
        }
    }

    /**
     * Generate phone number
     */
    public static function Blacklist($data = []) : array
    {
        try {
            $params = ['action' => 'blacklist', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY'), 'website' => $data['website'], 'country' => $data['country_code'], 'phone_number' => $data['phone_number']];

            $response = Http::timeout(self::$timeout)->get('https://autofications.com/V2/API.php', $params);
            if ($response->failed()) {
                return [
                    'status' => 0,
                    'info' => 'Reading Sms Failed. Try Again Later.'
                ];
            }

            return [
                'status' => 1,
                'response' => $response->json(),
                'info' => 'Reading sms passed.'
            ];
        } catch (Exception $error) {
            return [
                'status' => 0,
                'info' => 'Network Error. Try Again.'
            ];
        }
    }

    /**
     * Generate phone number
     */
    public static function ChaeckBalance($data = []) : array
    {
        try {
            $params = ['action' => 'balance', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' => env('AUTOFICATIONS_API_KEY')];

            $response = Http::timeout(self::$timeout)->get(env('AUTOFICATIONS_BASE_URL'), $params);
            if ($response->failed()) {
                return [
                    'status' => 0,
                    'info' => 'Reading Sms Failed. Try Again Later.'
                ];
            }

            return [
                'status' => 1,
                'balance' => $response->json(),
                'info' => 'Reading sms passed.'
            ];
        } catch (Exception $error) {
            return [
                'status' => 0,
                'info' => 'Network Error. Try Again.'
            ];
        }
    }

}