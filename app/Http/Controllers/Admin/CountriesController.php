<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Validator;

class CountriesController extends Controller
{
    //
    public function index()
    {
        return view('admin.countries.index', ['title' => 'All Countries | Legitsms', 'countries' => Country::orderBy('name', 'asc')->paginate(20)]);
    }

    //
    public function add()
    {
        $data = request()->all(['id_number', 'name']);
        $validator = Validator::make($data, [ 
            'name' => ['required', 'string'],  
            'id_number' => ['required', 'string', 'unique:countries'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $country = Country::where(['name' => $data['name']])->first();
        if (!empty($country)) {
            return response()->json([
                'status' => 0,
                'info' => 'Country already added.'
            ]);
        }

        try {

            $country = Country::create([
                'name' => $data['name'],
                'id_number' => $data['id_number'],
            ]);

            return $country->id > 0 ? response()->json([
                'status' => 1,
                'info' => ' Country added.',
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
        $data = request()->all(['id_number', 'name']);
        $validator = Validator::make($data, [ 
            'name' => ['required', 'string'],  
            'id_number' => ['required', 'string'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $country = Country::find($id);
        if (empty($country)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }

        try {

            $country->name = $data['name'];
            $country->id_number = $data['id_number'];
            return $country->update() ? response()->json([
                'status' => 1,
                'info' => ' Country updated.',
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
            $country = Country::find($id);
            if (empty($country)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown error. Try again.'
                ]);
            }

            if ($country->websites()->exists()) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Country is already in use'
                ]);
            }

            return $country->delete() ? response()->json([
                'status' => 1,
                'info' => ' Country deleted.',
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
