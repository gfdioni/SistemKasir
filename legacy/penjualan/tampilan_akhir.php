<h5>Halaman Penjualan Umum</h5>

<?php
include("koneksi.php");
$username=@$_SESSION['username'];

$query1 		= "select * from penjualan  where username = '$username' order by tgl_jual DESC, jam_jual DESC";
$eks_query1 	= mysql_query($query1);
$hasil_query1	= mysql_fetch_array($eks_query1);
$total			= $hasil_query1['total_harga'];
$bayar			= $hasil_query1['bayar'];
$kembali		= $bayar-$total;

?>


<center>
	<h3>
	Total : <?php echo"Rp. ".number_format($total,0,",",".").""; ?><br />
	Tunai : <?php echo"Rp. ".number_format($bayar,0,",",".").""; ?></h3>
	<font color="red"><h3>
	Kembali : <?php echo"Rp. ".number_format($kembali,0,",",".").""; ?><br />
	</font></h3>
	<form action="?page=penjualan_insert" method="post">
	<input type="submit" value="SELESAI" autofocus />
	</form>
</center>

