<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Rules\EmailRule;
use \Exception;
use Validator;
use Mail;

class ContactController extends Controller
{
    /**
     * Conatct page view
     */
    public function index()
    {

        return view('frontend.contact.index', ['title' => 'Contact | Legitsms']);
    }

    /**
     * Send contact message
     */
    public function send()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
            'email' => ['required', (new EmailRule)], 
            'message' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($data));
            return response()->json([
                'status' => 1,
                'info' => 'Thank you for contacting us. We would get back to you shortly.',
                'redirect' => route('contact', ['success' => 'true']),
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => config('app.env') !== 'production' ? $error->getMessage() : 'Network Error. Try Again.'
            ]);
        }
    }

}
