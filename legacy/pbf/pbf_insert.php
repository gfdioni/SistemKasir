<h5>Tambah DAta PBF</h5>
<script language="javascript" type="text/javascript">
function validate_form ( )
{
    valid = true;
	var telp = /^[0-9]+$/;
	
	if ( document.tambah.nama_pbf.value == "" )
    {
        alert ( "nama PBF belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.alamat_pbf.value == "" )
    {
        alert ( "alamat PBF belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.no_telp_pbf.value == "" )
    {
        alert ( "telepon PBF belum diisi." );
        valid = false;
    }
	
	if ( !document.tambah.no_telp_pbf.value.match(telp) )
    {
        alert ( "telepon harus angka." );
        valid = false;
    }
	
    return valid;
}
</script>

<form name="tambah" method="post" action="?page=pbf_insert_action" onsubmit="return validate_form ();">
<table border = "0">
<tr>
	<td width="70">Kode PBF</td> 
	<td>:</td>
	<td><font color="#00CCFF"><i>kode akan di-generate secara otomatis</i></font></td>
</tr>
<tr>
	<td>Nama PBF</td> 
	<td>:</td>
	<td><input type="text" name="nama_pbf" size="40" autocomplete="off"/></td>
</tr>
<tr>
	<td>Alamat</td> 
	<td>:</td>
	<td><textarea name="alamat_pbf" rows="3" autocomplete="off"></textarea></td>
</tr>
<tr>
	<td>Telp</td>
	<td>:</td> 
	<td><input type="text" name="no_telp_pbf" autocomplete="off" /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" name="submit" value="TAMBAH" /> <input type="reset" name="reset" value="RESET" /></td>
</tr>
</table>
</form>
<br /><a href='?page=pbf_view'>Lihat data PBF</a>
