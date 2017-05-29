<h5>Ubah Data Karyawan</h5>

<script language="javascript" type="text/javascript">
function validate_form ( )
{
    valid = true;
	
	if ( document.update.password1.value == "" )
    {
        alert ( "password belum diisi." );
        valid = false;
    }
	
	if ( document.update.password2.value == "" )
    {
        alert ( "konfirmasi password belum diisi." );
        valid = false;
    }
	
	if ( document.update.password1.value != document.update.password2.value )
    {
        alert ( "password tidak cocok." );
        valid = false;
    }
	
    return valid;
}
</script>

<?php
include("koneksi.php");
$username 	= $_GET['username'];
$query		= "SELECT * FROM KARYAWAN WHERE username='$username'";
$hasil		= mysql_query($query);
$baris		= mysql_fetch_array($hasil); // untuk mengambil array ke - n dari tabel Karyawan
?>

<form method="post" action="?page=karyawan_update_action" onsubmit="return validate_form()" name="update">
<table border = "0">
<tr>
	<td>Username: </td> 
	<td><?php echo"$username"?> 
		<input type="hidden" value="<?php echo"$username"?>" name="username" /></td>
</tr>
<!--<tr>
	<td>Jabatan</td> 
	<td><select name="jabatan_lama" size="1">
		<option value="<?php //echo("$baris[jabatan]"); ?>"> <?php //echo("$baris[jabatan]"); ?> </option>
		</select>
		
		<select name="jabatan_baru" size="1">
		<option value="pemilik">pemilik</option>
		<option value="supervisor">supervisor</option>
		<option value="kasir">kasir</option>
		</select>
	</td>
</tr>-->
<tr>
	<td>Password baru:</td>
	<td><input type="password" name="password1" /></td>
</tr>
<tr>
	<td>Ulangi password:</td>
	<td><input type="password" name="password2" /></td>
</tr>
<tr>
	<td><input type="submit" name="submit" value="update" /></td>
</tr>
</table>
</form>

<?php
include("footer.php");
?>
