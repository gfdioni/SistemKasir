<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login_page()
    {
    	return view('auth/login_page');
    }
}
