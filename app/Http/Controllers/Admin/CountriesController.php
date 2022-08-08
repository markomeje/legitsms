<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Countries;

class CountriesController extends Controller
{
    //
    public function index()
    {
        return view('admin.countries.index', ['title' => 'All Countries | Legitsms', 'countries' => Country::all()]);
    }
}
