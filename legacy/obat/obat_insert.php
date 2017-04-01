<h5>Tambah Data Obat</h5>

<script language="javascript" type="text/javascript">
function validate_form ()
{
    valid = true;
	var kodeObat = /^[0-9]+$/;
	
	if ( document.tambah.kode_obat.value == "" )
    {
        alert ( "kode obat belum diisi." );
        valid = false;
    }
	
	if ( !document.tambah.kode_obat.value.match(kodeObat) )
    {
        alert ( "kode obat harus angka." );
        valid = false;
    }
	
	if ( document.tambah.nama_obat.value == "" )
    {
        alert ( "nama obat belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.satuan.value == "" )
    {
        alert ( "satuan obat belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.harga.value == "" )
    {
        alert ( "harga obat belum diisi." );
        valid = false;
    }
	
	if ( document.tambah.harga_langganan.value == "" )
    {
        alert ( "harga obat langganan belum diisi." );
        valid = false;
    }
	
	if ( !document.tambah.harga.value.match(kodeObat) )
    {
        alert ( "harga harus angka." );
        valid = false;
    }
	if ( !document.tambah.harga_langgnan.value.match(kodeObat) )
    {
        alert ( "harga langganan harus angka." );
        valid = false;
    }
	if ( document.tambah.stok_min.value == "" )
    {
        alert ( "Stok minimal belum diisi." );
        valid = false;
    }
	
	if ( !document.tambah.stok_min.value.match(kodeObat) )
    {
        alert ( "Stok minimal harus angka." );
        valid = false;
    }
	if ( document.tambah.stok_min_etalase.value == "" )
    {
        alert ( "Stok minimal etalase belum diisi." );
        valid = false;
    }
	
	if ( !document.tambah.stok_min_etalase.value.match(kodeObat) )
    {
        alert ( "Stok minimal etalase harus angka." );
        valid = false;
    }
	
    return valid;
}
</script>

<form name="tambah" method="post" action="?page=obat_insert_action" onsubmit="return validate_form();">
<table border = "0">
<tr>
	<td>kode obat</td> 
	<td><input type="text" name="kode_obat" autocomplete="off"/></td>
</tr>
<tr>
	<td>nama obat</td> 
	<td><input type="text" name="nama_obat" size="40" autocomplete="off"/> </td>
</tr>
<tr>
	<td>satuan</td> 
	<td><select name="satuan" size="1">
		<option value="STRIP">STRIP</option>
		<option value="TABLET">TABLET</option>
		<option value="TUBE">TUBE</option>
		<option value="BOTOL">BOTOL</option>
		<option value="FLASH">FLASH</option>
		<option value="SACHET">SACHET</option>
		<option value="PACK">PACK</option>
		<option value="KEMASAN">KEMASAN</option>
		</select>
	</td>
</tr>
<tr>
	<td>harga (Rp)</td> 
	<td><input type="text" name="harga" autocomplete="off"/></td>
</tr>
<tr>
	<td>harga Langganan (Rp)</td> 
	<td><input type="text" name="harga_langganan" autocomplete="off" /></td>
</tr>
<tr>
	<td>Stok Min Gudang</td> 
	<td><input type="text" name="stok_min" autocomplete="off" /></td>
</tr>
<tr>
	<td>Stok Min Etalase</td> 
	<td><input type="text" name="stok_min_etalase" autocomplete="off" /></td>
</tr>
<tr>
	<td>No Rak</td> 
	<td><input type="text" name="rak" autocomplete="off" /></td>
</tr>
<tr>
	<td><input type="submit" name="submit" /></td>
	<td><input type="reset" name="reset" /></td>
</tr>
</table>
</form>
<br /><a href='?page=obat_view'>Lihat data Obat</a>
