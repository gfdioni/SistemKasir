<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
    	return view("auth/login_page");
    }

    public function home()
    {
    	echo 1;
    }
}
