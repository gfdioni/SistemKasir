<h5>Tampil Resep Dan Kwitansi</h5>

<?php
include("koneksi.php");
$nomor	=$_POST['nomor'];
$pasien	=$_POST['pasien'];
$uang	=$_POST['uang'];
$untuk	=$_POST['untuk'];
$dokter	=$_POST['dokter'];
$angka	=$_POST['angka'];

$insert	= "insert into resep values ('$nomor','$pasien','$uang','$untuk','$dokter','$angka',now())";
mysql_query($insert);

if($insert){?>
	<script language="JavaScript" type="text/javascript">
		alert("Resep / Kwitansi Disimpan");
	</script>
<?
}// TUTUP if($insert){?>

<!-- ======================================================================================================================================  -->
<?php 
$query			= "select * from resep order by tgl DESC";
$eks_query		= mysql_query($query);
$ambil_query	= mysql_fetch_array($eks_query);
$no				= $ambil_query[0];
$pasien			= $ambil_query[1];
$uang			= $ambil_query[2];
$untuk			= $ambil_query[3];
$dokter			= $ambil_query[4];
$angka			= $ambil_query[5];
$tgl			= $ambil_query[6];
?>

<center>
<table border="0">
	<tr>
		<td rowspan="6" width="60"><img src="farmasi.jpg" /></td>
	</tr>
	<tr align="center">
		<td><font size="+1"><b>APOTEK TRIDAYA BUANA SEJAHTERA (TBS)</b></font></td>
	</tr>
	<tr align="center">
		<td>Apoteker : R. Pertiwi D,S.Farm.,Apt</td>
	</tr>
	<tr align="center">
		<td>No. Sp : KP. 01.03.1.3.2830</td>
	</tr>
	<tr align="center">
		<td>Griya Bandung Asri 2 Blok M2 No. 19 Bandung</td>
	</tr>
	<tr align="center">
		<td>Telp (022) - 7532003 - 7531945</td>
	</tr>
</table>
<br /><hr />
<font size="+2">KWITANSI</font>
<hr />
</center>

<table>
	<tr>
		<td>No Resep</td>
		<td>:</td>
		<td><?php echo $no; ?></td>
	</tr>
	<tr>
		<td>Telah Terima Dari</td>
		<td>:</td>
		<td><?php echo $pasien; ?></td>
	</tr>
	<tr>
		<td>Uang Sejumlah</td>
		<td>:</td>
		<td><?php echo $uang; ?></td>
	</tr>
	<tr>
		<td>Untuk Pembayaran</td>
		<td>:</td>
		<td><?php echo $untuk; ?></td>
	</tr>
	<tr>
		<td>Resep / Obat dr</td>
		<td>:</td>
		<td><?php echo $dokter; ?></td>
	</tr>
	<tr>
		<td>Rp</td>
		<td>:</td>
		<td><?php echo"Rp. ".number_format($angka,0,",",".").",00"; ?></td>
	</tr>
</table>
<hr />

<?php
	//Tampilkan Tanggal
	echo "Bandung, $tgl";
	//echo $tgl_jual=date('Ym');
?>
<br /><br /><br /><br /><br />
(Apotek TBS)<br />


<!--------------------------------------------------- SCRIPT UNTUK PRINT -------------------------------------------------------------------->

<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="jquery.printPage.js" type="text/javascript"></script>

<script>  
	$(document).ready(function(){
	$(".btnPrint").printPage();
	});
</script>
<center><font size="+2">
<a class="btnPrint" href='iframes/print_kwitansi.php'>PRINT!</a>
</font></center>

