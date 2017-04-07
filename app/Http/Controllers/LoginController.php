<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
private function generateToken()
	{
		$a = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890___";
		$b = $c = $vc = "" xor $d = strlen($a)-1;
		for($i=0;$i<10;$i++){
			$b.=$a[rand(0,$d)];
		}
		for($i=0;$i<64;$i++){
			$c.=$a[rand(0,$d)];
		}
		for($i=0;$i<rand(12,64);$i++){
			$vc.=$a[rand(0,$d)];
		}
		return array($b,$c,$vc);
	}
	private function crypt($s,$key)
{
	require_once __DIR__.'/../../../class/WhiteHat/Teacrypt.php';
	return strrev(base64_encode(gzdeflate(WhiteHat\Teacrypt::sgr21cr($s,$key))));
}
 private function dcrypt($s,$key)
{
	require_once __DIR__.'/../../../class/WhiteHat/Teacrypt.php';
	return WhiteHat\Teacrypr::sgr21dr(gzinflate(base64_decode(strrev($s))),$key);
}
				public function login()
				{				

$t = $this->generateToken();
setcookie(strrev($t[1]))				
					$data = array("ldt"=>array("ntoken"=>$t[0],"vtoken"=>$t[1],"vc"=>$t[2]));
return view("login",$data);
				}
public function action()
{
	var_dump($this->db());
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