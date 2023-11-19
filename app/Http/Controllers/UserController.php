<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\cabang;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $listuser = User::all();
        $listcabang = cabang::where('status','1')->get();
        return view('pages.user')->with(compact('listcabang','listuser'));
    }

    public function create(Request $request)
    {
        $phoneNumber = preg_replace("/[^0-9]/", "", $request->inPhone);

        $newUser = new User();
        $newUser->name = $request->inName;
        $newUser->role = $request->inRole;
        $newUser->status = $request->inStatus;
        $newUser->cabang = $request->inCabang;
        $newUser->phone = $phoneNumber;
        $newUser->email = $request->inEmail;
        $newUser->password = Hash::make($request->inPassword);
        $newUser->save();

        return redirect(route('user.view'));
    }
}
