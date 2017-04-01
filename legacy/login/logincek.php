<?php
 
include "koneksi.php";
$username = $_POST['username'];
$password = md5($_POST['password']);
 
// query untuk mendapatkan record dari username
$query = "SELECT * FROM karyawan WHERE username = '$username' and password = '$password' ";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
 
// cek kesesuaian password
if ($password == $data['password'] && $username == $data['username']) 
{
    ?><script language script="JavaScript">alert('Anda login sebagai <?php echo $data['username']?> - <?php echo $data['jabatan']?>');</script><?php
 
    // menyimpan username dan level ke dalam session
    $_SESSION['username'] = $data['username'];
    $_SESSION['jabatan'] = $data['jabatan'];
 
    // tampilkan menu
     ?><script language script="JavaScript">document.location='index.php';</script><?php
 
}
?>
<script language script="JavaScript">alert("Username/Password yang anda masukkan salah!");document.location='index.php';</script>