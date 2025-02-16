<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    //Login
    public function login(){
        return view('auth.login');
    }


    public function dashboard(){
        return view('app.dashboard');
    }

}
