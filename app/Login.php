<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function gent()
    {
        return \rstr();
    }
}
