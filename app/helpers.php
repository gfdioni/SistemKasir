<?php


function rstr(int $n = 32, string $list = "", bool $pure = false)
{
    if ($pure) {
        $list = $concatation;
        $len  = strlen($list) - 1;
    } else {
        $len  = 64 + strlen($list);
        $list = "1234567890QWERTYUIOPASDFGHJKLXCVBNMqwertyuiopasdfghjklzxcvbnm____".$list;
    }
    $return = "";

    for ($i=0; $i < $n; $i++) {
        $return .= $list[rand(0, $len)];
    }

    return $return;
}

function teacrypt(string $string, string $key = "laravel")
{
    return  WhiteHat\Encryption\Teacrypt::encrypt($string, $key);
}

function teadecrypt(string $string, string $key = "laravel")
{
    return  WhiteHat\Encryption\Teacrypt::decrypt($string, $key);
}