<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ddevice;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->role == 5)
        {
            //Record Distinct
            $listDevice = Ddevice::select('ddevices.name', 'devices.idcabang', 'ddevices.value1', 'ddevices.value2', 'ddevices.value10', 'ddevices.value9', 'ddevices.value3', 'ddevices.value11', 'ddevices.created_at')
                ->join('devices', 'ddevices.name', '=', 'devices.name')
                ->join(DB::raw("(SELECT name, MAX(created_at) as latest_created_at FROM ddevices GROUP BY name limit 10) latest"), function ($join) {
                    $join->on('ddevices.name', '=', 'latest.name');
                    $join->on('ddevices.created_at', '=', 'latest.latest_created_at');
                })
                ->orderBy('ddevices.name','ASC')
                ->distinct()
                ->get();
        }else{
            //Record Distinct
            $listDevice = Ddevice::select('ddevices.name', 'devices.idcabang', 'ddevices.value1', 'ddevices.value2', 'ddevices.value10', 'ddevices.value9', 'ddevices.value3', 'ddevices.value11', 'ddevices.created_at')
                ->join('devices', 'ddevices.name', '=', 'devices.name')
                ->join(DB::raw("(SELECT name, MAX(created_at) as latest_created_at FROM ddevices GROUP BY name limit 10) latest"), function ($join) {
                    $join->on('ddevices.name', '=', 'latest.name');
                    $join->on('ddevices.created_at', '=', 'latest.latest_created_at');
                })
                ->where('devices.idcabang', '=', Auth::user()->cabang)
                ->orderBy('ddevices.name','ASC')
                ->distinct()
                ->get();
        }
       
            
        return view('pages.laporan')->with(compact('listDevice'));
    }

    public function ajaxModalData(Request $request)
    {
        $data = ddevice::where('name',$request->name)->orderBy('created_at','DESC')->limit(1500)->get();
        $devices = $data->map(function ($device, $index) {
            $device->no = $index + 1;
            return $device;
        });
        return $devices;
    }
}
