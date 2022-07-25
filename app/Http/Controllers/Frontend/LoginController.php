<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\EmailRule;
use Validator;
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
                    'info' => 'Invalid login details.'
                ]);
            }

            if (auth()->attempt(['email' => $user->email, 'password' => $data['password']])) {
                request()->session()->regenerate();
                return response()->json([
                    'status' => 1,
                    'info' => 'Operation successful.', 
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

    //
    public function verify()
    {
        return view('auth.signup.verify', ['title' => "Signup Verification | Geoprecise Services Limited"]);
    }
}
