<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\settings;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $isiSetting = settings::all();
        return view('pages.settings')->with('settings', $isiSetting);
    }

    public function save(Request $request)
    {
        $request->validate([
            'API_KEY' => 'required',
            'WA_TOKEN' => 'required',
        ]);

        $setApiKey = settings::where('key','API_KEY')->first();
        $setApiKey->value = $request->API_KEY;
        $setApiKey->save();

        $setWablasToken = settings::where('key','WA_TOKEN')->first();
        $setWablasToken->value = $request->WA_TOKEN;
        $setWablasToken->save();

        return redirect(route('setting.view'));
    }
}
