<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Transaction;
use App\Enums\TxnType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DepositController extends Controller
{

    public function deposit()
    {
        return view('frontend.deposit.now');
    }

    public function depositLog()
    {
        $users = auth()->user();
        $transactions = Transaction::where(function ($query) {
            $query->where('type', TxnType::Investment);
        })->get();

        return view('user.log', compact('transactions'));
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

        $validator = Validator::make($request->all(), [
            "method" => ['required'],
            "invest_amount" => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/']
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }
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
        ];


        Transaction::create($data);





        // $transaction = Transaction::create($request->validate([
        //     "method" => 'required',
        //     "invest_amount" => 'required|email',
        //     'type' => 'Deposit',
        //     'user_id' => auth()->id(),
        // ]));

        // Alert::success('Deposit Successfully', 'Added to Transanctions Log');
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->showConfirmButton('Confirm', '#3085d6');
        // example:
        alert()->success('Deposit Successfully', 'Added to Transanctions Log.')->persistent(true, false);

        return redirect()->back();
    }
}
