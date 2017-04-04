<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_page() {
        return response("Berhasil", 200);
    }
}
