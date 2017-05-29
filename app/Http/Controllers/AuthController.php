<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function login_page(LoginRequest $request) {
    	$method = $request->only('username', 'password');
    	$user = DB::table('users')->where('username', $method['username'])->get(array('password'));
    	return response(array($user))->header('Content-Type', 'application/json');
    }    
}
