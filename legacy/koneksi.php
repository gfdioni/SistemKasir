<?php
$koneksi=mysqli_connect("localhost","root","");
if($koneksi){
	//echo("Koneksi berhasil</br></br>");
	//echo("<h2>SISTEM INFORMASI PEMBELIAN DAN PENJUALAN OBAT</h2><hr />");
	mysqli_select_db($koneksi, "toko_obat_legacy") or die ("</br> Database tidak ada");
}
else{
	echo("Koneksi gagal");
}
?>
