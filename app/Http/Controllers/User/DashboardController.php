<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Exception;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('user.dashboard.index', ['title' => 'My Dashboard | Legitsms']);
    }

    public function update()
    {
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'username' => ['required', 'string', 'max:15'],  
            'email' => ['required', 'email'],  
            'password' => ['required'],  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $user = auth()->user();
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);

        if ($user->update()) {
            auth()->logout();
            return response()->json([
                'status' => 1,
                'info' => 'Operation failed. Try again.',
                'redirect' => route('logout')
            ]);
        }

        return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);

    }
}
