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
	 * Generate phone number
	 */
	public static function generate($data = []) : array
	{
		try {
			$params = ['action' => 'generate', 'username' => env('AUTOFICATIONS_USERNAME'), 'key' = env('AUTOFICATIONS_API_KEY'), 'website' => $data['website'], 'country' => $data['country']];

            $response = Http::timeout(self::$timeout)->get(env('AUTOFICATIONS_BASE_URL'), $params);
            if ($response->failed()) {
                return [
                    'status' => 0,
                    'info' => 'Verification Failed. Try Again Later.'
                ];
            }

            return (array)$response->json();
        } catch (Exception $error) {
            return [
                'status' => 0,
                'info' => 'Network Error. Try Again.'
            ];
        }
	}
}