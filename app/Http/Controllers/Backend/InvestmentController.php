<?php

namespace App\Http\Controllers\Backend;


use App\Enums\TxnType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvestmentController extends Controller
{
    public function investlog(Request $request)
    {
        $transactdata = Transaction::all();
        return view('backend.deposit.index', compact('transactdata'));
    }

    /**
     * @param Request $request
     * @throws Exception
     */
    public function payouts(Request $request)
    {
        $transactdata = Transaction::where(function ($query) {
            $query->where('type', TxnType::Withdraw);
        })->get();

        return view('backend.withdraw.payouts', compact('data'));
    }
}
