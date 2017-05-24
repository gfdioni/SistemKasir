<h5>Halaman Retur</h5>

<script language="javascript" type="text/javascript">
function validate_form(){
	valid = true;
	
	if ( document.retur.no_faktur.value == "" ){
        alert ( "Nomor Faktur belum diisi" );
        valid = false;
    }
	 return valid;
}
</script>


<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);
?>

<form name="retur" method="post" action="?page=retur" onsubmit="return validate_form()">
	Masukkan nomor faktur  = <input type="text" name="no_faktur" autocomplete="off" autofocus value="<?php echo $_POST['no_faktur']?>" />
	<input type="submit" name="submit" value="cari" />
</form> 