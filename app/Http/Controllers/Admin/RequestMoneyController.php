<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Transactions;
use Illuminate\Support\Facades\Route;
class RequestMoneyController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        $data = Transactions::where('status', '1')->orderBy('id', 'DESC')->get();
        return view('admin.user_batch.index', compact('data'));
    }

    public function approved()
    {
        $data = Transactions::where('status', '2')->orderBy('id', 'DESC')->get();
        return view('admin.user_batch.index', compact('data'));
    }

    public function transferred()
    {
        $data = Transactions::where('status', '3')->orderBy('id', 'DESC')->get();
        return view('admin.user_batch.index', compact('data'));
    }

    public function update(Request $request, Transactions $transaction)
    {
        return view('admin.user_batch.update', compact('transaction'));
    }

    public function edit(Request $request, Transactions $transaction, $status)
    {
        $uri = 'approved';

        $transaction->status = $status;

        if($status == '3')
        {
            $transaction->transfer_at = date('Y-m-d H:i:s');
            $transaction->txn_id = 'COD_000'.$transaction->id;
            $uri = 'transferred';
        }

        $transaction->update();
        return redirect('money-requests/'.$uri)->with('success', 'Status Updated Successfully ...!!');
    }
}
