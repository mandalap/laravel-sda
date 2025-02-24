<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function login(){
        return view('register.login');
    }

    public function daftar(){
        return view('register.daftar');
    }

    public function lupapassword(){
        return view('register.lupa-password');
    }
}
