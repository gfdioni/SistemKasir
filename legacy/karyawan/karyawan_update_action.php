<?php
include("koneksi.php");
$username    = $_POST['username'];
//$jabatan	= $_POST['jabatan_baru'];
$password1    = $_POST['password1'];
$password2    = $_POST['password2'];
$query        = "UPDATE KARYAWAN SET username='$username', password=md5('$password2') WHERE username = '$username'";
$eks        = mysql_query($query);
//header("Location:?page=index");

if (isset($_POST['submit'])) {
    if ($eks) {
        ?>
		<script language="javascript">
			alert('Password berhasil diganti');
			document.location='index.php';
		</script>		
	<?php

    }
}
?>


