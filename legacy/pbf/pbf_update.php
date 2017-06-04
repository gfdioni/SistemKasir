<h5>Ubah Data PBF</h5>
<?php
include("koneksi.php");
$kode_pbf = $_GET['kode_pbf'];
$query="SELECT * FROM PBF WHERE kode_pbf='$kode_pbf'";
$hasil=mysql_query($query);
$baris=mysql_fetch_array($hasil); // untuk mengambil array ke - n dari tabel PBF
?>

<form method="post" action="?page=pbf_update_action">
<table border = "0">
<tr>
	<td>kode PBF : </td> 
	<td><?php echo"$kode_pbf"?>
		<input type="hidden" value="<?php echo"$kode_pbf"?>" name="kode_pbf" /></td>
</tr>
<tr>
	<td>nama PBF</td> 
	<td><input type="text" name="nama_pbf" size="40" value="<?php echo("$baris[nama_pbf]"); ?>" /></td>
</tr>
<tr>
	<td>alamat</td> 
	<td><input type="text" name="alamat_pbf" size="40" value="<?php echo("$baris[alamat]"); ?>" /></td>
</tr>
<tr>
	<td>no. telp</td> 
	<td><input type="text" name="no_telp_pbf" value="<?php echo("$baris[no_telp]"); ?>" /></td>
</tr>
</table>
<br /><input type="submit" name="submit" value="update" /></td>
</form>

