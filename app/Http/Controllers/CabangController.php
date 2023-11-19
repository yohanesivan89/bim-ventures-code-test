<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\cabang;

class CabangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $listcabang = cabang::where('status','1')->get();
        return view('pages.cabang')->with('listcabang', $listcabang);
    }

    public function create(Request $request)
    {
        $newCabang = new cabang();
        $newCabang->nama = strtoupper($request->nama);
        $newCabang->notifbefore = $request->notifkurang;
        $newCabang->notifafter = $request->notiflebih;
        $newCabang->status = '1';
        $newCabang->statusnotif = $request->statusnotif;
        $newCabang->save();

        return redirect('cabang');
    }
}
