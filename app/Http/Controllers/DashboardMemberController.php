<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;
use App\Role;
use Illuminate\Support\Facades\Hash;

class DashboardMemberController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        
        return view('pages.m-dashboard');
    }
}
