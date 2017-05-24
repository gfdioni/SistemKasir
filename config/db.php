<?php
$a = array(
"DB_CONNECTION=",
"DB_HOST=",
"DB_DATABASE=",
"DB_USERNAME=",
"DB_PASSWORD=");
$b = file_get_contents(__DIR__.'/../.env');
$t = array();
foreach ($a as $a) {
    $z = explode($a, $b, 2);
    $x = explode("\n", $z[1]);
    $t[] = trim($x[0]);
}
$db = array(
"conn"=>$t[0],
"host"=>$t[1],
"dbname"=>$t[2],
"user"=>$t[3],
"pass"=>$t[4]
);
