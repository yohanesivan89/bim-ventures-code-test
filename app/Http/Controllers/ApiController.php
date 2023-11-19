<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ddevice;
use App\settings;
use App\device;
use App\user;
use App\cabang;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;

class ApiController extends Controller
{
    public function inputData(Request $request)
    {
        $apikey = settings::select('value')->where('key','API_KEY')->first()->value;

        $data = [];
        $cekDevice = device::where('name',$request->device)->first();

        $newDevice = new ddevice();

        if($apikey == $request->api_key.'')
        {
            $newDevice->name = $request->device;
            $newDevice->sensor = $request->sensor;
            $newDevice->value1 = $request->value1;
            $newDevice->value2 = $request->value2;
            $newDevice->value3 = $request->value3;
            $newDevice->value4 = $request->value4;
            $newDevice->value5 = $request->value5;
            $newDevice->value6 = $request->value6;
            $newDevice->value7 = $request->value7;
            $newDevice->value8 = $request->value8;
            $newDevice->value9 = $request->value9;
            $newDevice->value10 = $request->value10;
            $newDevice->value11 = $request->value11;
            $newDevice->created_at = Carbon::now()->subSecond($request->value5);
            $newDevice->save();

            $data = array(
                'value1' => floatval($cekDevice->kon1),
                'value2' => floatval($cekDevice->kon2),
                'value3' => floatval($cekDevice->cal1),
                'value4' => floatval($cekDevice->cal2),
                'value5' => floatval($cekDevice->auth),
                'value6' => floatval($cekDevice->adc),
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 0,
                'message' => 'missmatch api key',
            );
        }

        if($cekDevice)
        {
            $cabang = cabang::find($cekDevice->idcabang);

            //Time checking
            $startTime = strtotime($cabang->notifafter);
            $endTime = strtotime($cabang->notifbefore);

            $created_atTimestamp = strtotime($newDevice->created_at);

            if (!($created_atTimestamp >= $startTime && $created_atTimestamp <= $endTime && $cabang->statusnotif == '1')) {
                return response()->json($data, 200);
            }

            if($request->value7 != 0)
            {
                $idcabang = $cekDevice->idcabang;
                $users = User::where('cabang', $idcabang)->where('role', '<=', $request->value7)->get();

                $sendSms = array();
                $sendSms['data'] = array();

                foreach ($users as $user) {
                    $temp['phone'] = $user->phone;
                    $temp['message'] = $newDevice->name.'<br>'
                    .'Temperatur Suhu 1 Sudah '.$newDevice->value1.'°C ( batas minimal suhu aman '.$newDevice->value2.'°C !! ) '.'<br>'
                    .'Temperatur Suhu 2 Sudah '.$newDevice->value9.'°C ( batas minimal suhu aman '.$newDevice->value10.'°C !! ) '.'<br>'
                    .'CEPAT PERIKSA !!!';
                    array_push($sendSms['data'], $temp);
                }
                //Send SMS
                $this->sendSMS(json_encode($sendSms));
            }
        }

        return response()->json($data, 200);
    }

    public function checkConnection(Request $request)
    {
        $apikey = settings::select('value')->where('key','API_KEY')->first()->value;
        $cekDevice = device::where('name',$request->device)->first();

        $data = [];

        if($apikey == $request->api_key.'')
        {
            if($cekDevice)
            {
                $idcabang = $cekDevice->idcabang;
                $users = User::where('cabang', $idcabang)->where('role', '=', '5')->get();

                $sendSms = array();
                $sendSms['data'] = array();

                foreach ($users as $user) {
                    $temp['phone'] = $user->phone;
                    $temp['message'] = $request->device.' connected.'.'<br>'
                    .'MAC = '.$request->mac.'<br>'
                    .'SENSOR = '.$request->sensor.'<br>';
                    array_push($sendSms['data'], $temp);
                }
                //Send SMS
                $this->sendSMS(json_encode($sendSms));
            }
        }

        return 1;
    }

    public function calibration(Request $request)
    {
        $apikey = settings::select('value')->where('key','API_KEY')->first()->value;
        $cekDevice = device::where('name',$request->device)->first();

        $data = [];

        if($apikey == $request->api_key.'')
        {
            if($cekDevice)
            {
                $data = array(
                    'value1' => floatval($cekDevice->kon1),
                    'value2' => floatval($cekDevice->kon2),
                    'value3' => floatval($cekDevice->cal1),
                    'value4' => floatval($cekDevice->cal2),
                    'value5' => floatval($cekDevice->auth),
                    'value6' => floatval($cekDevice->adc),
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'code' => 0,
                    'message' => 'device name not found',
                );
            }
        }else{
            $data = array(
                'status' => 'error',
                'code' => 0,
                'message' => 'missmatch api key',
            );
        }

        return response()->json($data, 200);
    }

    public function notifBattery(Request $request)
    {
        $apikey = settings::select('value')->where('key','API_KEY')->first()->value;

        if($apikey != $request->api_key.'')
        {
            return response()->json(0, 200);
        }

        //Record Distinct
        $listDevice = Ddevice::select('ddevices.name', 'devices.idcabang', 'ddevices.value4', 'ddevices.created_at')
        ->join('devices', 'ddevices.name', '=', 'devices.name')
        ->join(DB::raw("(SELECT name, MAX(created_at) as latest_created_at FROM ddevices GROUP BY name limit 10) latest"), function ($join) {
            $join->on('ddevices.name', '=', 'latest.name');
            $join->on('ddevices.created_at', '=', 'latest.latest_created_at');
        })
        ->orderBy('ddevices.name','ASC')
        ->distinct()
        ->get();

        $arrData = array();

        foreach ($listDevice as $device) {
            if($device->value4 < 30)
            {
                $arrData[$device->idcabang][] = $device;
            }
        }

        $dataMessage = array();
        foreach ($arrData as $key=>$data)
        {
            $namaCabang = cabang::find($key)->nama;
            $dataMessage[$key] = 'Daftar alat Low Battery (HIJAU) < 30 di '.$namaCabang.':';
            foreach ($arrData[$key] as $value) {
                $dataMessage[$key] .= '<br>';
                $dataMessage[$key] .= '- '.$value->name.' / '.$value->created_at.' / '.$value->value4.'%';
            }
        }

        $sendSms = array();
        $sendSms['data'] = array();

        foreach ($dataMessage as $key => $value) {
            $findUser = user::where('cabang',$key)->where('role', '<=', '5')->get();
            foreach ($findUser as $user) {
                $temp['phone'] = $user->phone;
                $temp['message'] = $value;
                array_push($sendSms['data'], $temp);
            }
        }

        $this->sendSMS(json_encode($sendSms));

        return response()->json(1, 200);
    }

    public function checkDeviceStatus(Request $request)
    {
        $apikey = settings::select('value')->where('key','API_KEY')->first()->value;

        if($apikey != $request->api_key.'')
        {
            return response()->json(0, 200);
        }

        $currentDateTime = Date::now();

        $listDevice = Ddevice::select('ddevices.name', 'devices.idcabang', 'ddevices.value4', 'ddevices.created_at')
            ->join('devices', 'ddevices.name', '=', 'devices.name')
            ->join(DB::raw("(SELECT name, MAX(created_at) as latest_created_at FROM ddevices GROUP BY name limit 10) latest"), function ($join) {
                $join->on('ddevices.name', '=', 'latest.name');
                $join->on('ddevices.created_at', '=', 'latest.latest_created_at');
            })
            ->where('devices.status','1')
            ->whereRaw("TIMESTAMPDIFF(MINUTE, ddevices.created_at, '$currentDateTime') > 30")
            ->orderBy('ddevices.name', 'ASC')
            ->distinct()
            ->get();

        $dataPercabang = array();

        foreach ($listDevice as $device) {
            $dataPercabang[$device->idcabang][] = $device;
        }

        $dataMessage = array();

        foreach ($dataPercabang as $key => $value) {
            $dataMessage[$key] = 'Daftar alat berstatus aktif (HIJAU) lebih dari 30 menit tidak kirim data:';
            foreach ($dataPercabang[$key] as $value) {
                $dataMessage[$key] .= '<br>';
                $dataMessage[$key] .= '- '.$value->name.': '.$value->created_at;
            }
        }

        $sendSms = array();
        $sendSms['data'] = array();

        foreach ($dataMessage as $key => $value) {
            $findUser = user::where('cabang',$key)->where('role', '<=', '5')->get();
            foreach ($findUser as $user) {
                $temp['phone'] = $user->phone;
                $temp['message'] = $value;
                array_push($sendSms['data'], $temp);
            }
        }

        $this->sendSMS(json_encode($sendSms));

        return response()->json(1, 200);
    }

    public function sendSMS($data)
    {
        $token = settings::where('key','WA_TOKEN')->first()->value;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                'Content-Type: application/json'
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_URL,  "https://solo.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}
