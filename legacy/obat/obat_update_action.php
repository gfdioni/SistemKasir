<?php
include("koneksi.php");
$kode_obat            = $_POST['kode_obat'];
$kode_obat_baru        = $_POST['kode_obat_baru'];
$nama_obat            = $_POST['nama_obat'];
$satuan            = $_POST['satuan_baru'];
$harga                = $_POST['harga'];
$harga_lang        = $_POST['harga_langganan'];
$stok_min            = $_POST['stok_min'];
$stok_min_etalase    = $_POST['stok_min_etalase'];
$rak                = $_POST['rak'];
$query        = "UPDATE OBAT SET kode_obat='$kode_obat_baru', nama_obat='$nama_obat', satuan='$satuan', harga='$harga',harga_langganan='$harga_lang', stok_min='$stok_min', stok_min_etalase='$stok_min_etalase', tgl_modifikasi=now(), rak='$rak' WHERE kode_obat = '$kode_obat'";
mysql_query($query);


?>
<script language='javascript'>
	alert('Data Obat Telah Diupdate');
	<?php echo("document.location='index.php?page=obat_view'"); ?>
</script>
