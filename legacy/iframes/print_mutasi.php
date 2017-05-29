<?php
include("../koneksi.php");?>

<h5>List Yang Akan DiMutasi :</h5>
<table border="1">
	<tr bgcolor="cyan" align="center">
		<td width="50">No</td>
		<td width="150">Kode Obat</td>
		<td width="350">Nama</td>
		<td width="120">Satuan</td>
		<td width="120">Jumlah Mutasi</td>
	</tr>
	<?php
	$count 			= 1;
	$lihat_mutasi 	= "select * from detail_mutasi dm, obat o where dm.kode_obat = o.kode_obat";
	$eks_lihat 		= mysql_query($lihat_mutasi);
	while($hasil_lihat=mysql_fetch_array($eks_lihat)){?>
		<tr align="center">
			<td><?php echo $count;?></td>
			<td><?php echo $hasil_lihat[1]; ?></td>
			<td><?php echo $hasil_lihat[4]; ?></td>
			<td><?php echo $hasil_lihat[5]; ?></td>
			<td><?php echo $hasil_lihat[2]; ?></td>
		</tr>
	<?
	$count++;
	} // TUTUP while($hasil_lihat=mysql_fetch_array($eks_lihat)){
	?>
</table><br /><br />

<?php
	//Tampilkan Tanggal
	$tgl 		= "select now() from awal";
	$eks_tgl 	= mysql_query($tgl);
	$ambil_tgl 	= mysql_fetch_array($eks_tgl);
	$hasil_tgl 	= $ambil_tgl[0];
	echo $hasil_tgl;
//echo date('Y-m-d');
?>
<br /><br /><br /><br /><br />
(Petugas Gudang)