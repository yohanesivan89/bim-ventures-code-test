<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ddevice;

use Illuminate\Support\Facades\DB;

class UnknownController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //Record Distinct No Devicename
        $latestRecords = Ddevice::select('ddevices.name', 'ddevices.value1', 'ddevices.value9', 'ddevices.value4', 'ddevices.created_at')
            ->leftJoin('devices', 'ddevices.name', '=', 'devices.name')
            ->whereNull('devices.name')
            ->join(DB::raw("(SELECT name, MAX(created_at) as latest_created_at FROM ddevices GROUP BY name limit 10) latest"), function ($join) {
                $join->on('ddevices.name', '=', 'latest.name');
                $join->on('ddevices.created_at', '=', 'latest.latest_created_at');
            })
            ->orderBy('ddevices.created_at', 'DESC')
            ->distinct()
            ->get();

        return view('pages.temp')->with('listData', $latestRecords);
    }

    public function ajaxDelete(Request $request)
    {
        //Record Distinct No Devicename
        $latestRecords = Ddevice::select('name')
        ->whereNotIn('name', DB::table('devices')->pluck('name')->toArray())
        ->delete();

        if($latestRecords)
        {
            return 1;
        }else{
            return 0;
        }
    }
}
