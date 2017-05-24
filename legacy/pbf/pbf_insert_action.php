<?php
include("koneksi.php");
$nama_pbf=$_POST['nama_pbf'];
$alamat_pbf=$_POST['alamat_pbf'];
$no_telp_pbf=$_POST['no_telp_pbf'];
$query="INSERT INTO PBF(kode_pbf,nama_pbf,alamat,no_telp) VALUES ('','$nama_pbf','$alamat_pbf','$no_telp_pbf')";
$eksekusi=mysql_query($query);
if (isset($eksekusi)) {
    ?>
	DATA PBF SUKSES DIMASUKKAN<br /><br />
	<table>
		<tr>
			<td>Nama PBF</td>
			<td>:</td>
			<td><?php echo $nama_pbf; ?></td>
		</tr>
		<tr>
			<td>Alamat PBF</td>
			<td>:</td>
			<td><?php echo $alamat_pbf; ?></td>
		</tr>
		<tr>
			<td>Telp PBF</td>
			<td>:</td>
			<td><?php echo $no_telp_pbf; ?></td>
		</tr>
	</table>
	<br /><a href="?page=pbf_insert">Tambah Data PBF Lagi</a> <?php 
} else {
    echo("Data Gagal Dimasukkan");
}
?>
