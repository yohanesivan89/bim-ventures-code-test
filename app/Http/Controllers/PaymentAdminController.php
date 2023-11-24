<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;
use App\D_Transaction;

class PaymentAdminController extends Controller
{
    public function detailView($id)
    {
        $trx = Transaction::find($id);
        if(!$trx)
        {
            return redirect(route('admin.dashboard'));
        }
        $listTrx = D_Transaction::where('trx_id', $id)->get();
        return view('pages.a-payment-detail')->with(compact('listTrx','trx'));
    }

    public function createPayment(Request $request)
    {
        $trx = Transaction::find($request->trxid);

        if(!$trx)
        {
            return redirect(route('admin.dashboard'));
        }

        $payAmount = floatval(str_replace(",","",$request->amount));
        $unpaidAmount = floatval(str_replace(",","",$trx->nett_amount));

        if($payAmount > $unpaidAmount)
        {   
            return redirect(route('admin.payment.detail', $trx->id));
        }

        $newTrx = new D_Transaction();
        $newTrx->trx_id = $trx->id;
        $newTrx->amount = floatval(str_replace(",","",$request->amount));
        $newTrx->desc = $request->desc;
        $newTrx->save();

        $trx->unpaid_amount = $unpaidAmount - $payAmount;
        $trx->save();

        return redirect(route('admin.payment.detail', $trx->id));
    }
}
