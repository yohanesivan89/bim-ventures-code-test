<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\cabang;
use App\device;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listdevice = device::all();
        $listcabang = cabang::where('status','1')->get();
        return view('pages.device')->with(compact('listcabang','listdevice'));
    }

    public function getDetail(Request $request)
    {
        $request->validate([
            'deviceid' => 'required'
        ]);

        $findDev = device::find($request->deviceid);
        $listcabang = cabang::where('status','1')->get();

        if($findDev)
        {
            return view('ajax.modal-device-detail')->with(compact('listcabang','findDev'))->render();
        }else{
            return 'Cabang salah!';
        }

    }

    public function updateDevice(Request $request)
    {
        $finddevice = device::find($request->deviceid);

        if($finddevice)
        {
            $cekduplicate = device::where('name', $request->namadevice)->first();
            if($cekduplicate)
            {
                if($cekduplicate->id != $finddevice->id)
                {
                    return redirect(route('device.view'));
                }
            }
            $finddevice->name = $request->namadevice;
            $finddevice->idcabang = $request->cabang;
            $finddevice->cal1 = $request->cal1;
            $finddevice->cal2 = $request->cal2;
            $finddevice->kon1 = $request->kon1;
            $finddevice->kon2 = $request->kon2;
            $finddevice->status = "0";
            if($request->status)
            {
                $finddevice->status = "1";
            }
            $finddevice->auth = $request->auth;
            $finddevice->adc = $request->adc;
            $finddevice->save();
        }

        return redirect(route('device.view'));
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddevice' => 'required'
        ]);

        $deleteDevice = device::find($request->iddevice);
        if($deleteDevice)
        {
            $deleteDevice->delete();
        }else{
            return 0;
        }

        return 1;
    }

    public function create(Request $request)
    {
        $cekNama = device::where('name', $request->namadevice)->first();
        if(!$cekNama)
        {
            $newdevice = new device();
            $newdevice->name = $request->namadevice;
            $newdevice->idcabang = $request->cabang;
            $newdevice->cal1 = $request->cal1;
            $newdevice->cal2 = $request->cal2;
            $newdevice->kon1 = $request->kon1;
            $newdevice->kon2 = $request->kon2;
            $newdevice->status = "0";
            if($request->status)
            {
                $newdevice->status = "1";
            }
            $newdevice->auth = $request->auth;
            $newdevice->adc = $request->adc;
            $newdevice->save();
        }

        return redirect(route('device.view'));
    }
}
