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
        return view('admin.websites.index', ['title' => 'All Websites | Legitsms', 'websites' => Website::paginate(2)]);
    }

    //
    public function add()
    {
        $data = request()->all(['name', 'price', 'country', 'code']);
        $validator = Validator::make($data, [ 
            'code' => ['required', 'string'],  
            'country' => ['nullable', 'integer'],  
            'name' => ['required', 'string'],  
            'price' => ['required', 'integer'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $webiste = Website::where(['code' => $data['code'], 'country_id' => $data['country']])->first();
        if (!empty($webiste)) {
            return response()->json([
                'status' => 0,
                'info' => "Website already added for selected country",
            ]);
        }

        try {

            $website = Website::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'code' => $data['code'],
                'country_id' => $data['country'],
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

    //
    public function edit($id = 0)
    {
        $data = request()->all(['price', 'name', 'code', 'country']);
        $validator = Validator::make($data, [ 
            'code' => ['required'],  
            'country' => ['required'],  
            'name' => ['required', 'string'],  
            'price' => ['required', 'string'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $website = Website::find($id);
        if (empty($website)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }

        try {
            $website->name = $data['name'];
            $website->price = $data['price'];
            $website->code = $data['code'];
            $website->country_id = $data['country'];

            return $website->update() ? response()->json([
                'status' => 1,
                'info' => ' Website updated.',
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
            $website = Website::find($id);
            if (empty($website)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown error. Try again.'
                ]);
            }

            if ($website->verifications()->exists()) {
                if ($website->verifications->count() > 0) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Webiste is already in use.'
                    ]);
                }
            }

            return $website->delete() ? response()->json([
                'status' => 1,
                'info' => ' Website deleted.',
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
