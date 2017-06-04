<?php
include("koneksi.php");
$kode_obat    = $_GET['kode_obat'];
$query        = "SELECT * FROM OBAT WHERE kode_obat='$kode_obat'";
$hasil        = mysql_query($query);
$baris        = mysql_fetch_array($hasil); // untuk mengambil array ke - n dari tabel Obat
?>

<b>UBAH DATA OBAT</b> <br /><br /><hr><br />
<form  name="update" method="post" action="?page=obat_update_action">
<table border = "0">
<tr>
	<input type="hidden" name="kode_obat" value="<?php echo $kode_obat ?>" />
	
	<td width="120">Kode Obat</td>
	<td>:</td> 
	<td><input type="text" name="kode_obat_baru" value="<?php echo"$kode_obat"?>" autocomplete="off" maxlength="16" /></td>
</tr>
<tr>
	<td>Nama Obat</td>
	<td>:</td> 
	<td><input type="text" name="nama_obat" size="50" value="<?php echo("$baris[nama_obat]"); ?>" autocomplete="off" />
	<font color="#FF0000"><b>PASTIKAN TIDAK ADA TANDA PETIK SATU (')</b></font>
	</td>
</tr>
<tr>
	<td>Satuan</td>
	<td>:</td> 
	<td><b><?php echo("$baris[satuan]"); ?></b>
		
		<select name="satuan_baru" size="1">
		<option value="STRIP">STRIP</option>
		<option value="TABLET">TABLET</option>
		<option value="TUBE">TUBE</option>
		<option value="BOTOL">BOTOL</option>
		<option value="FLASH">FLASH</option>
		<option value="SACHET">SACHET</option>
		<option value="PACK">PACK</option>
		<option value="KEMASAN">KEMASAN</option>
		</select>
		<font color="#FF0000"><b>PASTIKAN SATUAN SUDAH BENAR</b></font>
	</td>
</tr>
<tr>
	<td>Harga</td> 
	<td>:</td>
	<td><input type="text" name="harga" value="<?php echo("$baris[harga]"); ?>" autocomplete="off"/></td>
</tr>
<tr>
	<td>Harga Langganan</td>
	<td>:</td> 
	<td><input type="text" name="harga_langganan" value="<?php echo("$baris[harga_langganan]"); ?>" autocomplete="off"/></td>
</tr>
<tr>
	<td>Stok Minimal Gudang</td> 
	<td>:</td> 
	<td><input type="text" name="stok_min" value="<?php echo("$baris[stok_min]"); ?>" autocomplete="off"/></td>
</tr>
<tr>
	<td>Stok Minimal Etalase</td> 
	<td>:</td> 
	<td><input type="text" name="stok_min_etalase" value="<?php echo("$baris[stok_min_etalase]"); ?>" autocomplete="off"/></td>
</tr>
<tr>
	<td>No Rak</td> 
	<td>:</td> 
	<td><input type="text" name="rak" value="<?php echo("$baris[rak]"); ?>" autocomplete="off"/></td>
</tr>
<tr>
	<td><input type="submit" name="submit" value="UPDATE" /></td>
</tr>
</table>
</form>