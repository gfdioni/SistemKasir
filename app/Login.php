<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use WhiteHat\Encryption\Teacrypt;

class Login extends Model
{
    public function check_login($username, $password)
    {
		if(DB::table('users')->where('name', $username)->value('password')==$password) {
			return true;
		} else {
			return false;
		}
    }
}
