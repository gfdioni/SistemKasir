<h5>Data Pencarian PBF</h5>
<?php
include("koneksi.php");

//query untuk menghapus data pbf
$kode_pbf = @$_GET['kode_pbf'];
$query = "DELETE FROM PBF WHERE kode_pbf = '$kode_pbf'";
mysql_query($query);
?>

<script language="JavaScript" type="text/javascript">
function confirmDeletee() {
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

<?php
echo("<table border='1'>");
echo("<tr align='center' bgcolor='blue'>
		<td width='100'>Kode PBF</td>
		<td width='200'>Nama PBF</td>
		<td width='400'>Alamat</td>
		<td width='150'>Telepon</td>
		<td width='150' colspan='2'>Operasi</td></tr>
	 ");

$cari=$_POST['cari'];
$query="SELECT * FROM PBF WHERE nama_pbf LIKE '%$cari%' ORDER BY kode_pbf";
$hasil_pencarian=mysql_query($query);
$jumlah=mysql_num_rows($hasil_pencarian);
if($jumlah>0){
	echo("<br/>Data yang ditemukan dari keyword '$cari' : $jumlah<br><br>");
	while($data=mysql_fetch_row($hasil_pencarian)){
		echo("<tr align='center'> 
			<td>$data[0]</td> 
			<td>$data[1]</td> 
			<td>$data[2]</td> 
			<td>$data[3]</td> 
			<td><a href=\"?page=pbf_view&kode_pbf=$data[0]\" onClick='return confirmDeletee();'>hapus</a></td> 
			<td><a href=\"?page=pbf_update&kode_pbf=$data[0]\">edit</a></td> </tr>
		");
	}
}
else{
	echo("Data dengan keyword '$cari' tidak ditemukan <br><br>");
}

echo("</table>");
echo("<FORM METHOD='POST' ACTION='?page=pbf_view'>");
echo("<br/><input type='submit' name='submit' value='Kembali'></form>");
?>
