<h5>Tampil Resep Dan Kwitansi</h5>

<b>Cari Data Kwitansi / Resep</b><br /><br />
<form method="post" action="?page=cari_resep">
	Masukkan Nomor / Nama Pasien / Nama Dokter : 
	<input type="text" name="cari_resep" size="20" autocomplete="off" autofocus/>
	<input type="submit" name="cari" value="CARI" />
</form>

<?php
if (isset($_POST['cari'])) {
    include("koneksi.php");
    $cari_resep = $_POST['cari_resep']; ?>
	
	<br />
	<table border="1">
		<tr bgcolor="cyan" align="center">
			<td width="30">No</td>
			<td width="80">No Resep</td>
			<td width="200">Nama Pasien</td>
			<td width="200">Nama Dokter</td>
			<td width="100">Jumlah Uang</td>
			<td width="300">Untuk pembayaran</td>
			<td width="100">Tanggal</td>
			<td width="50">Edit</td>
		</tr>
	<?php
    $count        = 1;
    $query        = "select * from resep where (pasien like '%$cari_resep%' OR dokter like '%$cari_resep%' OR no like '%$cari_resep%') order by tgl DESC";
    $eks_query    = mysql_query($query);
    while ($ambil_query    = mysql_fetch_array($eks_query)) {
        $no        = $ambil_query[0];
        $pasien    = $ambil_query[1];
        $uang    = $ambil_query[2];
        $untuk    = $ambil_query[3];
        $dokter    = $ambil_query[4];
        $angka    = $ambil_query[5];
        $tgl    = $ambil_query[6]; ?>
	
		<tr align="center">
			<td><?php echo $count; ?></td>
			<td><?php echo $no; ?></td>
			<td><?php echo $pasien; ?></td>
			<td><?php echo $dokter; ?></td>
			<td><?php echo "Rp. ".number_format($angka, 0, ",", ".").",00"; ?></td>
			<td><?php echo $untuk; ?></td>
			<td><?php echo $tgl ?></td>
			<td><?php echo "<a href=\"?page=resep_update&no=$no\">edit</a>" ?></td>
		</tr>
		<?php
        $count++;
    } // TUTUP while($ambil_query	= mysql_fetch_array($eks_query)){?>
	</table>
	<hr /><br />
	
	<!--------------------------------------------------- SCRIPT UNTUK PRINT -------------------------------------------------------------------->
	
	<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
	<script src="jquery.printPage.js" type="text/javascript"></script>
	
	<script>  
		$(document).ready(function(){
		$(".btnPrint").printPage();
		});
	</script>
	<center><font size="+2">
	<a class="btnPrint" href='iframes/print_kwitansi_cari.php?cari_resep=<?php echo $cari_resep; ?>'>PRINT!</a>
	</font></center>

<?php

} // TUTUP if(isset($_POST['cari'])){
?>

