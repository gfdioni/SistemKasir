<?php
include("koneksi.php");

$no_struk 	= $_GET['no_struk'];
$kode_obat 	= $_GET['kode_obat'];
$no_batch 	= $_GET['no_batch'];
$harga	 	= $_GET['harga'];
$qty	 	= $_GET['qty'];
$nama_obat	= $_GET['nama_obat'];
$id			= $_GET['id'];

$query		= "select o.kode_obat, o.nama_obat, o.satuan, o.harga, dp.no_batch, dp.jumlah from obat o, batch b, detail_penjualan dp
where o.kode_obat = b.kode_obat and dp.no_batch = b.no_batch and dp.no_struk = '$no_struk' and dp.no_batch = '$no_batch'";
$hasil		= mysql_query($query);
$baris		= mysql_fetch_array($hasil); // untuk mengambil array ke - n dari tabel Obat
?>

UBAH DATA PENJUALAN <br /><br />
<b>No Struk = <?php echo $no_struk; ?></b><br /><br />
<form method="post" action="?page=penjualan_update_form_action">

	<input type="hidden" value="<?php echo"$no_struk"?>" name="no_struk" />
	<table border = "0">
		<tr>
			<td>Kode Obat</td>
			<td>:</td> 
			<td><?php echo"$kode_obat"?> 
				<input type="hidden" value="<?php echo"$kode_obat"?>" name="kode_obat" /></td>
		</tr>
		<tr>
			<td>Nama Obat</td> 
			<td>:</td> 
			<td><?php echo"$nama_obat"?> 
			<input type="hidden" value="<?php echo"$nama_obat"; ?>" name="nama_obat" /></td>
		</tr>
		<tr>
			<td>No Batch</td> 
			<td>:</td> 
			<td><?php echo"$no_batch"?> 
			<input type="hidden" value="<?php echo"$no_batch"; ?>" name="no_batch" /></td>
		</tr>
		<tr>
			<td>Harga</td> 
			<td>:</td> 
			<td><?php echo"$harga"?> 
			<input type="hidden" name="harga" value="<?php echo"$harga"; ?>" /></td>
		</tr>
		<tr>
			<td>Qty</td> 
			<td>:</td> 
			<td><input type="text" name="qty" value="<?php echo"$qty"; ?>" autocomplete="off" autofocus/></td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" value="UPDATE" /></td>
		</tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $id;?>" />
</form>