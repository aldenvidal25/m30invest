<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class TransactionController extends Controller
{

    public function transactions(Request $request)
    {
        $transactdata = Transaction::all();

        return view('backend.transaction.index', compact('transactdata'));
    }
}
