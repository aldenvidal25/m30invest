<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactions()
    {
        return view('user.transaction.index');
    }
}
