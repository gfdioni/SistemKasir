<h5>Halaman EDIT Resep Dan Kwitansi</h5>

<script>
function validate_form ()
{
    valid = true;
	var angka = /^[0-9]+$/;
	
	if ( document.resep.nomor_baru.value == "" )
    {
        alert ( "Nomor belum diisi." );
        valid = false;
    }
	if ( document.resep.pasien_baru.value == "" )
    {
        alert ( "nama pasien belum diisi." );
        valid = false;
    }	
	if ( document.resep.uang_baru.value == "" )
    {
        alert ( "uang sejumlah obat belum diisi." );
        valid = false;
    }	
	if ( document.resep.untuk_baru.value == "" )
    {
        alert ( "untuk pembayaran belum diisi." );
        valid = false;
    }	
	if ( document.resep.dokter_baru.value == "" )
    {
        alert ( "nama dokter belum diisi." );
        valid = false;
    }
	if ( document.resep.angka_baru.value == "" )
    {
        alert ( "Jumlah nominal angka belum diisi." );
        valid = false;
    }
		if ( !document.resep.angka_baru.value.match(angka) )
    {
        alert ( "Nominal uang harus angka." );
        valid = false;
    }
    return valid;
}
</script>

<?php
include("koneksi.php");
$no = $_GET['no'];

$query			= "select * from resep where no = '$no' order by tgl DESC";
$eks_query		= mysql_query($query);
$ambil_query	= mysql_fetch_array($eks_query);
$no				= $ambil_query[0];
$pasien			= $ambil_query[1];
$uang			= $ambil_query[2];
$untuk			= $ambil_query[3];
$dokter			= $ambil_query[4];
$angka			= $ambil_query[5];
$tgl			= $ambil_query[6];
?>

<form name="resep" method="post" onsubmit="return validate_form();">
<table>
	<tr>
		<td>No Resep</td>
		<td>:</td>
		<td><input type="text" name="nomor_baru" size="50" autocomplete="off" value="<?php echo $no; ?>" /></td>
	</tr>
	<tr>
		<td>Nama Pasien</td>
		<td>:</td>
		<td><input type="text" name="pasien_baru" size="50" autocomplete="off" value="<?php echo $pasien; ?>" /></td>
	</tr>
	<tr>
		<td>Uang Sejumlah</td>
		<td>:</td>
		<td><input type="text" name="uang_baru" size="50" autocomplete="off" value="<?php echo $uang; ?>"/> </td>
	</tr>
	<tr>
		<td>Untuk Pembayaran</td>
		<td>:</td>
		<td><input type="text" name="untuk_baru" size="50" autocomplete="off" value="<?php echo $untuk; ?>"/></td>
	</tr>
	<tr>
		<td>Nama Dokter</td>
		<td>:</td>
		<td><input type="text" name="dokter_baru" size="50" autocomplete="off" value="<?php echo $dokter; ?>"/></td>
	</tr>
	<tr>
		<td>Rp</td>
		<td>:</td>
		<td><input type="text" name="angka_baru" size="50" autocomplete="off" value="<?php echo $angka; ?>" /><b> JANGAN MENGGUNAKAN TITIK ATAU KOMA. HANYA ANGKA SAJA!</b></td>
	</tr>
</table>
<input type="submit" name="update" value="UPDATE" />
</form>

<?php
if(isset($_POST['update'])){
	$nomor_baru		=$_POST['nomor_baru'];
	$pasien_baru	=$_POST['pasien_baru'];
	$uang_baru		=$_POST['uang_baru'];
	$untuk_baru		=$_POST['untuk_baru'];
	$dokter_baru	=$_POST['dokter_baru'];
	$angka_baru		=$_POST['angka_baru'];
	
	$update = "update resep set no='$nomor_baru', pasien='$pasien_baru', uang='$uang_baru', untuk='$untuk_baru', dokter='$dokter_baru', angka='$angka_baru' where no='$no'";
	mysql_query($update); ?>
	<script language="JavaScript" type="text/javascript">
		alert("Resep / Kwitansi Berhasil Di Edit");
		document.location='index.php?page=cari_resep';
	</script>
	<?php
} //TUTUP if(isset($_POST['update'])){
?>

