<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Rules\EmailRule;
use Validator;
use Cookie;
use Hash;
use Mail;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('frontend.login.index', ['title' => "Login | Legitsms"]);
    }

    //
    public function login()
    {
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'email' => ['required', (new EmailRule)],  
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            $user = User::where(['email' => $data['email']])->first();
            if (empty($user)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Invalid user login details.'
                ]);
            }

            if ($user->verified === true) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Please verify your email. A verification link was sent to your email during signup.'
                ]);
            }

            if (auth()->attempt(['email' => $user->email, 'password' => $data['password']])) {
                request()->session()->regenerate();
                return response()->json([
                    'status' => 1,
                    'info' => 'Login successful. Please wait . . .', 
                    'redirect' => auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard'),
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Invalid login details'
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->invalidate();

        foreach(request()->cookie() as $name => $value) {
            Cookie::queue(Cookie::forget($name));
        }

        $redirect = request()->query('redirect');
        return Route::has($redirect) ? redirect()->route($redirect) : redirect()->route('login');
    }
}
