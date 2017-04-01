<script language="javascript" type="text/javascript">
function validate_form ( )
{
    valid = true;
	
	if ( document.tambah.username.value == "" )
    {
        alert ( "username belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.password1.value == "" )
    {
        alert ( "password belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.password2.value == "" )
    {
        alert ( "konfirmasi password belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.password1.value != document.tambah.password2.value )
    {
        alert ( "password tidak cocok." );
        valid = false;
    }
	
    return valid;
}
</script>

SILAHKAN MASUKKAN DATA KARYAWAN </br></br></br>
<form name="tambah" method="post" action="?page=karyawan_insert_action" onsubmit="return validate_form ();">
<table border = "0">
<tr>
	<td>username</td> 
	<td><input type="text" name="username"></td>
</tr>
<tr>
	<td>password</td> 
	<td><input type="password" name="password1"></td>
</tr>
	<td>ulangi password</td> 
	<td><input type="password" name="password2"></td>
</tr>
<tr>
	<td>jabatan</td>
	<td><select name="jabatan1" size="1">
		<option value="pemilik">Pemilik</option>
		<option value="supervisor">Supervisor</option>
		<option value="kasir">Kasir</option>
		</select>
	</td>
</tr>
<tr>
	<td><input type="submit"></td>
	<td><input type="reset"></td>
</tr>
</table>
</form>

<a href='?page=karyawan_view'>Lihat data Karyawan</a>