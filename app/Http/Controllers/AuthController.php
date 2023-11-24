<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $checkEmail = User::where('email',$request->email)->first();

        if($checkEmail)
        {
            if(Hash::check($request->password, $checkEmail->password))
            {
                $rememberMe = false;
                if(isset($request->rememberme))
                {
                    $rememberMe = true;
                }
                Auth::loginUsingId($checkEmail->id, $rememberMe);
                return redirect(route('dashboard'));
            }else{
                return Redirect::back()->withErrors(['msg' => 'Password missmatch']);
            }
        }else{
            return Redirect::back()->withErrors(['msg' => 'Email not found']);
        }
    }

    public function logout()
    {
        if(Auth::check())
        {
            Auth::logout();
        }
        return redirect(route('login'));
    }
}
