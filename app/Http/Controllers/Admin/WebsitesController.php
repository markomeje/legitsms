<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Website;
use Validator;
use Exception;

class WebsitesController extends Controller
{
    //
    public function index()
    {
        return view('admin.websites.index', ['title' => 'All Websites | Legitsms', 'websites' => Website::all()]);
    }

    //
    public function add()
    {
        $data = request()->all(['name', 'price', 'status', 'code']);
        $validator = Validator::make($data, [ 
            'code' => ['required', 'string'],  
            'status' => ['nullable', 'boolean'],  
            'name' => ['required', 'string'],  
            'price' => ['required', 'integer'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $webiste = Website::where(['code' => $data['code']])->first();
        if (!empty($webiste)) {
            return response()->json([
                'status' => 0,
                'info' => 'Website with already added.'
            ]);
        }

        $webiste = Website::where(['name' => $data['name']])->first();
        if (!empty($webiste)) {
            return response()->json([
                'status' => 0,
                'info' => 'Website with name added.'
            ]);
        }

        try {

            $website = Website::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'code' => $data['code'],
                'active' => true,
            ]);

            return $website->id > 0 ? response()->json([
                'status' => 1,
                'info' => ' Website added.',
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
