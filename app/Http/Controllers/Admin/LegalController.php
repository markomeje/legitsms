<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Legal;

class LegalController extends Controller
{
    //
    //
    public function add()
    {
        $data = request()->all(['question', 'answer']);
        $validator = Validator::make($data, [ 
            'answer' => ['required', 'string'],  
            'question' => ['required', 'string'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $faq = Faq::where(['question' => $data['question']])->first();
        if (!empty($faq)) {
            return response()->json([
                'status' => 0,
                'info' => 'Faq with already added.'
            ]);
        }

        try {

            $faq = Faq::create([
                'answer' => $data['answer'],
                'question' => $data['question'],
                'status' => true,
            ]);

            return $faq->id > 0 ? response()->json([
                'status' => 1,
                'info' => ' Faq added.',
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
        $data = request()->all(['question', 'answer']);
        $validator = Validator::make($data, [ 
            'answer' => ['required', 'string'],  
            'question' => ['required', 'string'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $faq = Faq::find($id);
        if (empty($faq)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }

        try {

            $faq->answer = $data['answer'];
            $faq->question = $data['question'];
            return $faq->update() ? response()->json([
                'status' => 1,
                'info' => ' Faq updated.',
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
