<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Legal;

class LegalController extends Controller
{
    //
    public function privacy()
    {
        $legal = Legal::where('id', '>', 0)->first();
        return view('frontend.legal.privacy', ['title' => 'Privacy Policy', 'privacy' => $legal->privacy ?? '']);
    }

    //
    public function terms()
    {
        $legal = Legal::where('id', '>', 0)->first();
        return view('frontend.legal.terms', ['title' => 'Terms of Service', 'terms' => $legal->terms ?? '']);
    }

    //
    public function cookies()
    {
        $legal = Legal::where('id', '>', 0)->first();
        return view('frontend.legal.cookies', ['title' => 'Cookies Policy', 'cookies' => $legal->cookies ?? '']);
    }
}
