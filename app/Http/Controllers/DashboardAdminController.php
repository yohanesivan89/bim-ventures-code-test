<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $listTrx = Transaction::where('status','1')->orderBy('due_date','ASC')->get();
        return view('pages.a-dashboard')->with(compact('listTrx'));
    }
}
