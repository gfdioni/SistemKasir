<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Login;

class AuthController extends Controller
{
    public function login(LoginRequest $request, Login $login)
    {
    	$i = $request->all();
    	$i = $login->check_login($i['username'], $i['password']) ? array("login"=>true,"alert"=>"","r"=>"/home") : array("login"=>false,"alert"=>"Username atau password salah!","r"=>"");
    	return response($i, 200)
    	->header("Content-type","application/json");
    }
}
