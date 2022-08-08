<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Deposit;

class DepositController extends Controller
{
    //
    public function index()
    {
        return view('admin.deposits.index', ['title' => 'All Deposits | Legitsms']);
    }
}
