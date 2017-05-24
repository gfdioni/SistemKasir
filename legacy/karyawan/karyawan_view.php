<h5>Halaman Karyawan</h5>

<?php
include("koneksi.php");

//query untuk menghapus data karyawan
$username = @$_GET['username'];
if ($username!="") {
    $query = "DELETE FROM KARYAWAN WHERE username = '$username'";
    mysql_query($query);
}
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

<form method="post" action="?page=karyawan_search">
Masukkan Username Karyawan : <input type="text" name="cari" autocomplete="off" autofocus>
<input type="submit" name="submit" value="Cari"><br>
</form>

<br />Data lengkap karyawan<br /><br />

<?php
echo("<table border='1'>");
echo("<tr align='center' bgcolor='cyan'>
		<td width='150'>Username</td>
		<td width='150'>Jabatan</td>
		<td width='150' colspan='2'>Operasi</td></tr>
	 ");
    
$query="SELECT * FROM KARYAWAN ORDER BY username";
$tampil_data=mysql_query($query);
while ($data=mysql_fetch_row($tampil_data)) {
    echo("<tr align='center'> 
			<td>$data[0]</td> 
			<td>$data[2]</td> 
			<td><a href=\"?page=karyawan_view&username=$data[0]\" onClick='return confirmDelete();'>hapus</a></td> 
			<td><a href=\"?page=karyawan_update&username=$data[0]\">edit</a></td> </tr>
		");
}
echo("</table>");
?>

<br /><a href="?page=karyawan_insert">Tambah data karyawan</a>

<?php
include("footer.php");
?>