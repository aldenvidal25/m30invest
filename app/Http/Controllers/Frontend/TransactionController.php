<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function transactions()
    {
        $users = auth()->user();
        $transactions = Transaction::where('user_id', $users->id);

        $recentTransactions = $transactions->latest()->take(5)->get();

        $dataCount = [
            'total_transactions' => $transactions->count(),
            'total_investment' => $users->totalInvestment(),
            'total_withdraw' => $users->totalWithdraw(),
        ];

        return view('frontend.user.transaction.index', compact('dataCount', 'transactions', 'recentTransactions'));
    }
}
