<?php
$koneksi=mysql_connect("localhost","root","masterodin");
if($koneksi){
	//echo("Koneksi berhasil</br></br>");
	//echo("<h2>SISTEM INFORMASI PEMBELIAN DAN PENJUALAN OBAT</h2><hr />");
	mysql_select_db("apotek") or die ("</br> Database tidak ada");
}
else{
	echo("Koneksi gagal");
}
?>