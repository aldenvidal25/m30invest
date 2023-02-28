<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Enums\TxnType;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{

    public function deposit()
    {
        return view('frontend.deposit.now');
    }

    public function depositLog()
    {
        $users = auth()->user();
        $transactions = Transaction::where('user_id', $users->id);

        $recentTransactions = $transactions->latest()->take(5)->get();

        $dataCount = [
            'total_transactions' => $transactions->count(),
            'total_investment' => $users->totalInvestment(),
            'total_withdraw' => $users->totalWithdraw(),
        ];
        return view('user.log', compact('transactions', 'recentTransactions'));
    }
    public function withdrawLog(Request $request)
    {
        $transactdata = Transaction::where(function ($query) {
            $query->where('type', TxnType::Withdraw);
        })->orderByDesc('created_at')->get();

        return view('user.withdraw_log', compact('transactdata'));
    }

    public function depositNow(Request $request)
    {


        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            "method" => ['required'],
            "invest_amount" => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/']
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(public_path('upload/admin_images'), $newImageName);

        $input = $request->all();
        //retrieves the investment amount from the input.

        // $validated = $request->validate([
        //     "method" => ['required'],
        //     "invest_amount" => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/']
        // ]);

        $validated = [
            'type' => 'Invest',
            'status' => 'Success',
            'user_id' => auth()->id()
        ];

        $investAmount = $input['invest_amount'];
        $investMethod = $input['method'];
        $depositType = $validated['type'];
        $status = $validated['status'];
        $user_id = $validated['user_id'];

        $transactionId = Str::random(10);
        $nextProfitTime = Carbon::now()->addDays(30);

        $data = [
            'user_id' => $user_id,
            'tnx' => $transactionId,
            'invest_amount' => $investAmount,
            'type' => $depositType,
            'method' => $investMethod,
            'next_profit_time' => $nextProfitTime,
            'status' => $status,
            'image_path' => $newImageName,
        ];

        Transaction::create($data);

        alert()->success('Deposit Successfully', 'Added to Transanctions Log.')->persistent(true, false);

        return redirect()->back();
    }
}
