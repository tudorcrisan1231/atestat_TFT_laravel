<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Login extends Controller
{
    public function loginAccount(){
        // dd('merge');
        return view('login');
    }
}
