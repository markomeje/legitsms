<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Legal;
use Validator;

class LegalController extends Controller
{
    //
    public function add()
    {
        $data = request()->all(['cookies', 'privacy', 'terms']);
        $validator = Validator::make($data, [ 
            'privacy' => ['required', 'string'],  
            'cookies' => ['required', 'string'],  
            'terms' => ['required', 'string'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            $legal = Legal::create([
                'privacy' => $data['privacy'],
                'cookies' => $data['cookies'],
                'terms' => $data['terms'],
            ]);

            return $legal->id > 0 ? response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => '',
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
    public function edit($id = 0)
    {
        $data = request()->all(['cookies', 'privacy', 'terms']);
        $validator = Validator::make($data, [ 
            'privacy' => ['required', 'string'],  
            'cookies' => ['required', 'string'],  
            'terms' => ['required', 'string'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $legal = Legal::find($id);
        if (empty($legal)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }

        try {

            $legal->privacy = $data['privacy'];
            $legal->cookies = $data['cookies'];
            $legal->terms = $data['terms'];
            return $legal->update() ? response()->json([
                'status' => 1,
                'info' => 'Successfully updated.',
                'redirect' => '',
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
}
