<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    //
    public function index()
    {
        return view('frontend.faq.index', ['title' => 'Frequently asked questions | Legitsms']);
    }
}
