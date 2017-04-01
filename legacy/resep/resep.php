<h5>Halaman Resep Dan Kwitansi</h5>

<script>
function validate_form ()
{
    valid = true;
	var angka = /^[0-9]+$/;
	
	if ( document.resep.nomor.value == "" )
    {
        alert ( "Nomor belum diisi." );
        valid = false;
    }
	if ( document.resep.pasien.value == "" )
    {
        alert ( "nama pasien belum diisi." );
        valid = false;
    }	
	if ( document.resep.uang.value == "" )
    {
        alert ( "uang sejumlah obat belum diisi." );
        valid = false;
    }	
	if ( document.resep.untuk.value == "" )
    {
        alert ( "untuk pembayaran belum diisi." );
        valid = false;
    }	
	if ( document.resep.dokter.value == "" )
    {
        alert ( "nama dokter belum diisi." );
        valid = false;
    }
	if ( document.resep.angka.value == "" )
    {
        alert ( "Jumlah nominal angka belum diisi." );
        valid = false;
    }
		if ( !document.resep.angka.value.match(angka) )
    {
        alert ( "Nominal uang harus angka." );
        valid = false;
    }
    return valid;
}
</script>

<?php
include("koneksi.php");
?>

<form name="resep" action="?page=tampil_resep" method="post" onsubmit="return validate_form();">
<table>
	<tr>
		<td>No Resep</td>
		<td>:</td>
		<td><input type="text" name="nomor" size="50" autocomplete="off" /></td>
	</tr>
	<tr>
		<td>Nama Pasien</td>
		<td>:</td>
		<td><input type="text" name="pasien" size="50" autocomplete="off" /></td>
	</tr>
	<tr>
		<td>Uang Sejumlah</td>
		<td>:</td>
		<td><input type="text" name="uang" size="50" autocomplete="off" /> </td>
	</tr>
	<tr>
		<td>Untuk Pembayaran</td>
		<td>:</td>
		<td><input type="text" name="untuk" size="50" autocomplete="off" /></td>
	</tr>
	<tr>
		<td>Nama Dokter</td>
		<td>:</td>
		<td><input type="text" name="dokter" size="50" autocomplete="off" /></td>
	</tr>
	<tr>
		<td>Rp</td>
		<td>:</td>
		<td><input type="text" name="angka" size="50" autocomplete="off" /><b> JANGAN MENGGUNAKAN TITIK ATAU KOMA. HANYA ANGKA SAJA!</b></td>
	</tr>
</table>
<input type="submit" name="simpan" value="SIMPAN" />
</form>

<br /><hr /><br />
<a href="?page=cari_resep"><b>Cari Data Kwitansi / Resep</b></a>

<!-- 
<br /><br />
<form method="post" action="?page=cari_resep">
	Masukkan Nomor / Nama Pasien / Nama Dokter : 
	<input type="text" name="cari_resep" size="20" autocomplete="off"/>
	<input type="submit" name="cari" value="CARI" />
	<br />
	<br />
	Pilih Periode : 
</form>
-->