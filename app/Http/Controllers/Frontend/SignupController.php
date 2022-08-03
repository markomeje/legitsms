<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{User, Verification};
use Illuminate\Support\Facades\DB;
use App\Mail\VerificationMail;
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
        ], ['retype.required' => 'Please enter same password', 'agree.required' => 'You have to agree to our terms and conditions', 'retype.same:password' => 'Retype thesame password']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            DB::rollback();
            $email = $data['email'] ?? null;
            $token = Str::random(64);
            $user = User::create([
                'email' => $email,
                'password' => Hash::make($data['password']),
                'role' => 'user',
                'status' => 'inactive',
                'token' => $token,
                'expiry' => Carbon::now()->addMinutes(2),
                'verified' => false,
            ]);

            if (empty($user)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown error. Try again later',
                ]);
            }

            $link = route('signup.verify', ['token' => $token]);
            $mail = new VerificationMail([
                'link' => $link, 
                'email' => $email, 
            ]);

            Mail::to($email)->send($mail);
            return response()->json([
                'status' => 1,
                'info' => 'Signup successful. Please wait . . .',
                'redirect' => route('signup', ['success' => 'true']),
            ]);
            DB::commit();
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }

    //
    public function verify()
    {
        $token = request()->get('token');
        return view('frontend.signup.verify', ['title' => "Signup Verification | Legitsms", 'token' => $token]);
    }

    //
    public function resend()
    {
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'email' => ['required', (new EmailRule)],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            $email = $data['email'] ?? null;
            $token = Str::random(64);
            $user = User::where(['email' => $email])->first();
            if (empty($user)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown error. Try again later',
                ]);
            }

            $user->token = $token;
            $user->expiry = Carbon::now()->addMinutes(2);
            $user->update();
            $link = route('signup.verify', ['token' => $token]);
            $mail = new VerificationMail([
                'link' => $link, 
                'email' => $email, 
            ]);

            Mail::to($email)->send($mail);
            return response()->json([
                'status' => 1,
                'info' => 'Verification email resent. Please wait . . .',
                'redirect' => route('signup.verify', ['resent' => 'true']),
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }
}
