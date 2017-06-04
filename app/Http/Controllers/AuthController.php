<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
    	$input = $request->all();
    	return response($input, 200)
    	->header("Content-type","application/json");
    }
}
