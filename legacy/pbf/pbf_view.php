<h5>HALAMAN PBF</h5>

<?php
include("koneksi.php");

//query untuk menghapus data pbf
$kode_pbf = @$_GET['kode_pbf'];
$query = "DELETE FROM PBF WHERE kode_pbf = '$kode_pbf'";
mysql_query($query);
?>

<script language="JavaScript" type="text/javascript">
function confirmDelete() {
	if (confirm("Hapus Data?")) {
		return true;
	}else {
		return false;
	}
}
</script> 

<form method="post" action="?page=pbf_search">
Masukkan Nama PBF : <input type="text" name="cari" autocomplete="off" autofocus>
<input type="submit" name="submit" value="Cari"><br>
</form>

<br />Data lengkap PBF<br /><br />

<?php
echo("<table border='1'>");
echo("<tr align='center' bgcolor='blue'>
		<td width='50'>Kode PBF</td>
		<td width='350'>Nama PBF</td>
		<td width='400'>Alamat</td>
		<td width='100'>Telepon</td>
		<td width='150' colspan='2'>Operasi</td></tr>
	 ");
	
$query="SELECT * FROM PBF ORDER BY kode_pbf";
$tampil_data=mysql_query($query);
while($data=mysql_fetch_row($tampil_data)){
	echo("<tr align='center'> 
			<td>$data[0]</td> 
			<td>$data[1]</td> 
			<td>$data[2]</td> 
			<td>$data[3]</td> 
			<td><a href=\"?page=pbf_view&kode_pbf=$data[0]\" onClick='return confirmDelete();'>hapus</a></td> 
			<td><a href=\"?page=pbf_update&kode_pbf=$data[0]\">edit</a></td> </tr>
		");
}
echo("</table>");
?>

<br /><a href="?page=pbf_insert">Tambah data PBF </a>
