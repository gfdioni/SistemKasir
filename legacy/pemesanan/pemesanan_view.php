<h1>Halaman Pemesanan</h1>
<hr />

<?php
include("koneksi.php");
?>

Daftar Pemesanan Pending<br /><br />

<table border="1">
	<tr align="center">
		<td width="150">ID Pesan</td>
		<td width="150">Tanggal Pesan</td>
		<td width="150">Kode PBF</td>
		<td width="150">Pemesan</td>
	</tr>
	<?php
    $query = "select pemesanan.id_pesan, pemesanan.tgl_pesan, pemesanan.kode_pbf, pemesanan.username from pemesanan,pembelian where pemesanan.id_pesan not in (select pembelian.id_pesan from pembelian) group by pemesanan.id_pesan";
    $eks = mysql_query($query);
    while ($row=mysql_fetch_array($eks)) {
        ?>
	<tr align="center">
		<td><?php echo $row[0]; ?></td>
		<td><?php echo $row[1]; ?></td>
		<td><?php echo $row[2]; ?></td>
		<td><?php echo $row[3]; ?></td>
	</tr>
	<?php	
    } // TUTUP WHILE
    ?>
</table>
<br /><a href="?page=pemesanan_insert">Tambah pemesanan</a>