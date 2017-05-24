<?php
include("koneksi.php");
$username=$_POST['username'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];
$jabatan1=$_POST['jabatan1'];

//cek apakah username sudah ada atau belum?
$cek="SELECT username FROM karyawan WHERE username='$username'";
$eksekusi_cek=mysql_query($cek);
$count=mysql_num_rows($eksekusi_cek);
if ($count>0) { //kondisi saat username sudah ada
    echo("<font color='red'>Gagal memasukkan data! Username sudah ada.</font></br>");
    echo("<a href='?page=karyawan_insert'>Kembali</a>");
} //END OF IF
else { //kondisi saat username belum ada
    $query="INSERT INTO KARYAWAN(username,password,jabatan) VALUES ('$username',md5('$password1'),'$jabatan1')";
    $eksekusi=mysql_query($query);
    if (isset($eksekusi)) {
        echo("DATA KARYAWAN SUKSES DIMASUKKAN <br/><br/>");
        echo("Username 	: $username<br/>");
        echo("Jabatan	: $jabatan1<br/>");
        echo("<FORM METHOD='POST' ACTION='?page=karyawan_insert' <br/>");
        echo("<input type='submit' name='submit' value='Masukkan Data Lagi'></form>");
        /*<FORM METHOD='POST' ACTION='?page=obat_insert'><br/>
            <input type='submit' name='submit' value='Masukkan data obat lagi'></form>*/
    } else {
        echo("Data Gagal Dimasukkan");
    }
} //END OF ELSE
?>

<?php
include("footer.php");
?>