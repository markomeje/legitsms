<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Social;
use Validator;

class SocialController extends Controller
{

    //
    public function add()
    {
        $data = request()->all(['platform', 'link']);
        $validator = Validator::make($data, [ 
            'platform' => ['required', 'string'],  
            'link' => ['required'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $company = $data['platform'] ?? '';
        $social = Social::where(['company' => $company])->first();
        if (!empty($social)) {
            return response()->json([
                'status' => 0,
                'info' => 'Social media already added.'
            ]);
        }

        try {

            $social = Social::create([
                'link' => $data['link'],
                'company' => $company,
            ]);

            return $social->id > 0 ? response()->json([
                'status' => 1,
                'info' => ' Social added.',
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
        $data = request()->all(['platform', 'link']);
        $validator = Validator::make($data, [ 
            'platform' => ['required', 'string'],  
            'link' => ['required'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $social = Social::find($id);
        if (empty($social)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }

        try {

            $social->link = $data['link'];
            $social->company = $data['platform'];
            return $social->update() ? response()->json([
                'status' => 1,
                'info' => ' Social updated.',
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
    public function delete($id = 0)
    {

        try {
            $Social = Social::find($id);
            if (empty($Social)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown error. Try again.'
                ]);
            }

            return $Social->delete() ? response()->json([
                'status' => 1,
                'info' => ' Social deleted.',
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
