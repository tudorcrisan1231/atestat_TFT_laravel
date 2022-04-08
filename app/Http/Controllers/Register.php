<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Register extends Controller
{
    public function createAccount(){
        // dd('merge');
        return view('register');
    }
}
