<?php
include("koneksi.php");
$kode_pbf=$_POST['kode_pbf'];
$nama_pbf = $_POST['nama_pbf'];
$alamat = $_POST['alamat_pbf'];
$no_telp = $_POST['no_telp_pbf'];
$query = "UPDATE PBF SET nama_pbf='$nama_pbf', alamat='$alamat', no_telp='$no_telp' WHERE kode_pbf = '$kode_pbf'";
$eks = mysql_query($query);
if ($eks) {
    ?>
<script language="javascript"> alert('Data berhasil di Update'); </script>
<?php

}
header("Location:?page=pbf_view");
?>
