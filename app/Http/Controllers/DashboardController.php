<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ddevice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.dashboard');
    }

    public function ajaxData()
    {
        //Record Distinct
        if(Auth::user()->role == '5')
        {
            $listDevice = Ddevice::select('ddevices.name', 'devices.status', 'cabangs.nama', 'ddevices.value1', 'ddevices.value4', 'ddevices.value9', 'ddevices.created_at')
                ->join('devices', 'ddevices.name', '=', 'devices.name')
                ->joinSub(function ($query) {
                    $query->select('name', DB::raw('MAX(created_at) as latest_created_at'))
                        ->from('ddevices')
                        ->groupBy('name')
                        ->limit(10);
                }, 'latest', function ($join) {
                    $join->on('ddevices.name', '=', 'latest.name');
                    $join->on('ddevices.created_at', '=', 'latest.latest_created_at');
                })
                ->join('cabangs', 'devices.idcabang', '=', 'cabangs.id')
                ->orderBy('cabangs.nama', 'ASC')
                ->orderBy('ddevices.name', 'ASC')
                ->distinct()
                ->get();
        }else{
            $listDevice = Ddevice::select('ddevices.name', 'devices.status', 'cabangs.nama', 'ddevices.value1', 'ddevices.value4', 'ddevices.value9', 'ddevices.created_at')
                ->join('devices', 'ddevices.name', '=', 'devices.name')
                ->joinSub(function ($query) {
                    $query->select('name', DB::raw('MAX(created_at) as latest_created_at'))
                        ->from('ddevices')
                        ->groupBy('name')
                        ->limit(10);
                }, 'latest', function ($join) {
                    $join->on('ddevices.name', '=', 'latest.name');
                    $join->on('ddevices.created_at', '=', 'latest.latest_created_at');
                })
                ->join('cabangs', 'devices.idcabang', '=', 'cabangs.id')
                ->where('devices.idcabang', '=', Auth::user()->cabang)
                ->orderBy('cabangs.nama', 'ASC')
                ->orderBy('ddevices.name', 'ASC')
                ->distinct()
                ->get();
        }
            
        $devices = $listDevice->map(function ($device, $index) {
            $device->no = $index + 1;
            return $device;
        });
        
        $arr['data'] = $devices;
        return $arr;
    }
}
