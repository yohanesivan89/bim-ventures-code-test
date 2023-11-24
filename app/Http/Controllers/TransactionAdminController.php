<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Transaction;

class TransactionAdminController extends Controller
{
    public function createView()
    {
        $listmember = User::where('role','1')->get();
        return view('pages.a-create-transaction')->with(compact('listmember'));
    }

    public function addTransaction(Request $request)
    {
        $newTrx = new Transaction();
        $newTrx->user_id = $request->iduser;
        $newTrx->vat = $request->vat;

        $amount = floatval(str_replace(",","",$request->amount));
        $nettamount = 0;

        if(isset($request->vatinc))
        {
            $nettamount = $amount;
            $newTrx->nett_amount = $amount;
            $newTrx->amount = $amount / (1 + ($request->vat / 100));
        }else{
            $nettamount = $amount + ($amount * $request->vat / 100);
            $newTrx->nett_amount = $nettamount;
            $newTrx->amount = $amount;
        }
        $newTrx->due_date = $request->duedate;
        $newTrx->unpaid_amount = $nettamount;
        $newTrx->save();
        return redirect(route('admin.dashboard'));
    }
}
