<h5>Halaman Update Penjualan</h5>

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);
$no_batch 	= @$_GET['no_batch'];
$no_struk 	= @$_GET['no_struk'];
$jumlah		= @$_GET['jumlah'];
if($no_batch!=""){
	$query = "DELETE FROM DETAIL_PENJUALAN WHERE no_batch = '$no_batch' AND no_struk = '$no_struk'";
	mysql_query($query);
	//$query1 = "";
}
?>

<script language="JavaScript" type="text/javascript">
function confirmDelete() {
	conf = true;
	
	if (confirm("Hapus Data?")) {
		conf = true;
	}else {
		conf = false;
	}
	return conf;
}
</script> 
 
<form name="jumlah" action="?page=penjualan_update" method="post">
<table border="0">
	<tr>
		<td>No Struk</td>
		<td>:</td>
		<td><input type="text" name="no_struk" autocomplete="off" autofocus/></td>
		<td><input type="submit" name="edit" value="EDIT" /></td>
	</tr>
</table>
</form>

<?php
if(isset($_POST['edit'])){ //script ini dilkukan saat button bernama "edit" ditekan ?>
	<br />
	<table border="1">
		<tr bgcolor="#00CC00" align="center">
			<td width="30">No</td>
			<td width="100">Kode Obat</td>
			<td width="300">Nama Obat</td>
			<td width="100">Satuan</td>
			<td width="100">Harga</td>
			<td width="100">batch</td>
			<td width="50">Qty</td>
			<td width="50">Diskon</td>
			<td width="100">Total</td>
			<td width="100">Operasi</td>
		</tr>
		<?php
		$no_struk=$_POST['no_struk'];
		$counter=1;
		$query="select o.kode_obat, left(o.nama_obat,28), o.satuan, dp.harga, dp.no_batch, dp.jumlah, dp.diskon, dp.total_harga, dp.id from obat o, batch b, 					
				detail_penjualan dp where o.kode_obat = b.kode_obat and dp.no_batch = b.no_batch and dp.no_struk = $no_struk order by o.nama_obat";
		$eks_query=mysql_query($query);
		while($data=mysql_fetch_row($eks_query)){ ?>
		<tr bgcolor="#99FFCC" align="center">
			<td><?php echo "$counter"; ?></td>
			<td><?php echo "$data[0]"; ?></td>
			<td><?php echo "$data[1]"; ?></td>
			<td><?php echo "$data[2]"; ?></td>
			<td><?php echo "$data[3]"; ?></td>
			<td><?php echo "$data[4]"; ?></td>
			<td><?php echo "$data[5]"; ?></td>
			<td><?php echo "$data[6]"; ?></td>
			<td><?php echo "$data[7]"; ?></td>
			<td><a href="?page=penjualan_update_form&no_struk=<?php echo "$no_struk";?>&kode_obat=<?php echo "$data[0]";?>&no_batch=<?php echo "$data[4]";?>&harga=<?php echo "$data[3]";?>&qty=<?php echo "$data[5]";?>&nama_obat=<?php echo "$data[1]";?>&id=<?php echo "$data[8]";?>">edit</a></td>
		</tr>
		<?php
		$counter++;
		} //tutup while($data=mysql_fetch_row($eks_query){
		?>
	</table>
	<?php	
} // tutup IF line if(isset($_POST['batal'])
?>

