<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = auth()->user();
        $transactions = Transaction::where('user_id', $users->id);

        $recentTransactions = $transactions->latest()->take(5)->get();

        $dataCount = [
            'total_transactions' => $transactions->count(),
            'total_investment' => $users->totalInvestment(),
            'total_withdraw' => $users->totalWithdraw(),
        ];

        return view('frontend.user.dashboard', compact('dataCount', 'transactions', 'recentTransactions'));
    }
}
