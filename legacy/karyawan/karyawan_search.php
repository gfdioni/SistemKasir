<?php
include("koneksi.php");

//query untuk menghapus data karyawan
$username = @$_GET['username'];
if($username!=""){
	$query = "DELETE FROM KARYAWAN WHERE username = '$username'";
	mysql_query($query);
}
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

<?php
echo("Data Pencarian Karyawan<hr></br>");
echo("<table border='1'>");
echo("<tr align='center' bgcolor='cyan'>
		<td width='150'>Username</td>
		<td width='150'>Jabatan</td>
		<td width='150' colspan='2'>Operasi</td></tr>
	 ");

$cari=$_POST['cari'];
$query="SELECT * FROM KARYAWAN WHERE username LIKE '%$cari%' ORDER BY username";
$hasil_pencarian=mysql_query($query);
$jumlah=mysql_num_rows($hasil_pencarian);
if($jumlah>0){
	echo("Data yang ditemukan dari keyword '$cari' : $jumlah<br><br>");
	while($data=mysql_fetch_row($hasil_pencarian)){
		echo("<tr align='center'> 
			<td>$data[0]</td>  
			<td>$data[2]</td> 
			<td><a href=\"?page=karyawan_view&username=$data[0]\" onClick='return confirmDeletee();'>hapus</a></td> 
			<td><a href=\"?page=karyawan_update&username=$data[0]\">edit</a></td> </tr>
		");
	}
}
else{
	echo("Data dengan keyword '$cari' tidak ditemukan <br><br>");
}

echo("</table>");
echo("<FORM METHOD=POST ACTION=?page=karyawan_view>");
echo("</br><input type='submit' name='submit' value='Kembali'></form>");
?>

<?php
include("footer.php");
?>