<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Form;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard.index', ['title' => 'Admin Dashboard | Legitsms']);
    }
}
