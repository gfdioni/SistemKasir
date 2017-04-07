<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
class LoginController extends Controller
{
private function generateToken()
	{
		return array($this->rstr(10),$this->rstr(64),$this->rstr(32));
	}
	private function crypt($s,$key)
{
	return strrev(base64_encode(gzdeflate(\WhiteHat\Teacrypt::sgr21cr($s,$key))));
}
 private function dcrypt($s,$key)
{
	return \WhiteHat\Teacrypt::sgr21dr(gzinflate(base64_decode(strrev($s))),$key);
}
public function login()
{				
$exp = 3600*24*14;
$t = $this->generateToken();
setcookie("lgkey",$this->crypt($t[1],$t[0]),time()+$exp);	
setcookie("vc",$t[2],time()+$exp);
setcookie("tkey",$this->crypt($t[0],"es teh"),time()+$exp);
					$data = array("ldt"=>array("ntoken"=>$t[0],"vtoken"=>$t[1],"vc"=>$t[2]));
return view("login",$data);
				}
public function action()
{
	if(!isset($_COOKIE['tkey'],$_COOKIE['lgkey'],$_COOKIE['vc'])){
		return view("ilegal_login");
	}
	$ntkn = $this->dcrypt($_COOKIE['tkey'],"es teh");
	if($_POST[$ntkn]!=($this->dcrypt($_COOKIE['lgkey'],$ntkn))){
		return view("ilegal_login");
	}
	$gst = filter_var($_POST['username'],FILTER_VALIDATE_EMAIL)?"`email`":"`username`";
	$pdo = $this->db();
	$st = $pdo->prepare("SELECT `username`,`password`,`block`,`userid` FROM `users` WHERE {$gst}=:user LIMIT 1;");
	$st->execute(array(
	':user'=>strtolower($_POST['username'])
	));
	$a = $st->fetch(PDO::FETCH_NUM);
	if($a===false){
		setcookie("alert","Wrong username or password !",time()+300);
		header("location:?ref=login_err");
		exit();
	} else {
		if($this->dcrypt($a[1],"ltm123")==$_POST['password']){
			if($a[2]=="true"){
				header("location:/checkpoint");
			} else {
				$exp = 3600*24*14;
				$session = $this->rstr(32).$a[3];
				$key = $this->rstr(64);
				$sess = $this->rstr(44).$a[3];
				$salt = $this->rstr(72);
				setcookie("sess",$this->crypt($sess,$key),time()+$exp);
				setcookie("ctk",$this->crypt($key,"ltm123"),time()+$exp);
				setcookie("user",$this->crypt($a[0],$key),time()+$exp);
				setcookie("wg",$salt,time()+$exp);
				setcookie("hsd",md5($sess.$key.$salt.$a[0]),time()+$exp);
$info = array(
"useragent"=>$_SERVER['HTTP_USER_AGENT'],
"ip"=>$_SERVER['REMOTE_ADDR']
);
$info = $this->crypt(json_encode($info),$key);
$st = $pdo->prepare("INSERT INTO `login_session` (`userid`,`tkey`,`encrypted_session`,`login_at`,`expired`,`device_info`) VALUES (:id,:key,:sess,:lgat,:exp,:devinfo);")->execute(
array(
':id'=>$a[3],
':key'=>$key,
':sess'=>$sess,
':lgat'=>(date("Y-m-d H:i:s")),
':exp'=>(date("Y-m-d H:i:s",time()+$exp)),
':devinfo'=>$info
)
);
header("location:?ref=self");
exit();
			}
		} else {
			setcookie("alert","Wrong username or password !",time()+300);
		header("location:?ref=login_err");
		exit();
		}
	}
}				
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "login";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}