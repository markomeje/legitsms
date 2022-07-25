<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{User, Verification};
use CraigPaul\Mail\TemplatedMailable;
use App\Rules\EmailRule;
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;

class SignupController extends Controller
{
    //
    public function index()
    {
        return view('frontend.signup.index', ['title' => "Signup | Legitsms"]);
    }

    //
    public function signup()
    {
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'email' => ['required', (new EmailRule), 'unique:users'],  
            'password' => ['required', 'string'],
            'retype' => ['required', 'same:password'],
            'agree' => ['required', 'string'],
        ], ['retype.required' => 'Please enter a password', 'agree.required' => 'You have to agree to our terms and conditions', 'retype.same:password' => 'Retype thesame password']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            $email = $data['email'] ?? '';
            $user = User::create([
                'email' => $email,
                'password' => Hash::make($data['password']),
                'role' => 'client',
                'status' => 'inactive',
            ]);

            if (empty($user)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown error. Try again later',
                ]);
            }

            $token = Str::random(64);
            Verification::create([
                'token' => $token,
                'type' => 'email',
                'expiry' => Carbon::now()->addMinutes(60),
                'user_id' => $user->id,
                'verified' => false,
            ]);

            // $company = config('app.name');
            // Mail::to($email)->send((new TemplatedMailable())->identifier(28625150)->include([
            //     'product_name' => $company,
            //     'name' => $fullname,
            //     'action_url' => route('signup.verify', ['token' => $token]),
            //     'company_name' => $company,
            //     'company_address' => config('app.address')
            // ]));

            return response()->json([
                'status' => 1,
                'info' => 'Signup successful. Please wait . . .',
                'redirect' => route('signup.ui', ['success' => 'true']),
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
