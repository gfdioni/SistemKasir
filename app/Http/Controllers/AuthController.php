<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function login_page(LoginRequest $request) {
    	$method = $request->only('username', 'password');

    	return response(array($method))->header('Content-Type', 'application/json');
    }    
}
