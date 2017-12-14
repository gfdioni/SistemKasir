<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    public function check_login($username, $password)
    {	

		if(	// get encrypted password and key
			$udata = DB::table("users")->select("ukey","password")->where("username", $username)->limit(1)->first() and

			// decrypt password with key
			teadecrypt($udata->password, $udata->ukey) === $password
			
			) {
			return true;
		} else {
			return false;
		}
    }
}
