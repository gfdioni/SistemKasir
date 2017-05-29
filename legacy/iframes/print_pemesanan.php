<?php
include("../koneksi.php");

$ambilid = "select * from pemesanan order by id_pesan desc";
$eksambilid = mysql_query($ambilid);
$eksid = mysql_fetch_row($eksambilid);
$id_pesan = $eksid[0];
$tgl_pesan = $eksid[1];
$username = $eksid[3];

$nama_pbf = "select pbf.nama_pbf from pbf,pemesanan pes, detail_pemesanan dp where pbf.kode_pbf = pes.kode_pbf AND pes.id_pesan = dp.id_pesan AND pes.id_pesan='$id_pesan'";
$eks2 = mysql_query($nama_pbf);
$row=mysql_fetch_array($eks2);
$nm_pbf = $row[0];?>
	
<hr />
<center>
<table border="0">
	<tr>
		<td rowspan="6" width="60"><img src="farmasi.jpg" /></td>
	</tr>
	<tr align="center">
		<td><font size="+1"><b>APOTEK TRIDAYA BUANA SEJAHTERA (TBS)</b></font></td>
	</tr>
	<tr align="center">
		<td>Apoteker : R. Pertiwi D,S.Farm.,Apt</td>
	</tr>
	<tr align="center">
		<td>No. Sp : KP. 01.03.1.3.2830</td>
	</tr>
	<tr align="center">
		<td>Griya Bandung Asri 2 Blok M2 No. 19 Bandung</td>
	</tr>
	<tr align="center">
		<td>Telp (022) - 7532003 - 7531945</td>
	</tr>
</table>
<hr />
<font size="+1"><b>SURAT PESANAN</b></font>
</center>

<font size="-1">
<table>
	<tr>
		<td width="100">Yth</td>
		<td>:</td>
		<td><b><?php echo $nm_pbf; ?></b></td>
	</tr>
	<tr>
		<td>No Pesanan</td>
		<td>:</td>
		<td><?php echo $id_pesan; ?></td>
	</tr>
	<tr>
		<td>Pemesan</td>
		<td>:</td>
		<td><?php echo $username; ?></td>
	</tr>
	<tr>
		<td>Tgl Pesan</td>
		<td>:</td>
		<td><?php echo date('d-m-Y', strtotime($tgl_pesan)); ?></td>
	</tr>
</table>
<br />
<table border="1">
	<tr align="center" bgcolor="#00FFFF">
		<td width="50">No</td>
		<td width="400">Nama Obat</td>
		<td width="70">Satuan</td>
		<td width="60">Jumlah</td>
	</tr>
	<?php
		$totitem = "select sum(jumlah) as jum from detail_pemesanan dp where id_pesan='$id_pesan' group by id_pesan";
		$ekstotitem = mysql_query($totitem);
		$hasil = mysql_fetch_array($ekstotitem);
		$total_item = $hasil[0];
	
		$detail_pesan = "select o.nama_obat,o.satuan,dp.jumlah from obat o,detail_pemesanan dp where o.kode_obat=dp.kode_obat AND dp.id_pesan='$id_pesan'";
		$eks3 = mysql_query($detail_pesan);
		$item = mysql_num_rows($eks3);
		$no=1;
		while($row=mysql_fetch_array($eks3)){
			?>
			<tr>
				<td align="center"><?php echo $no; ?></td>
				<td align="center"><?php echo $row['nama_obat']; ?></td>
				<td align="center"><?php echo $row['satuan']; ?></td>
				<td align="center"><?php echo $row['jumlah']; ?></td>
			</tr>
			<?php	
			$no++;	
		} // tutup WHILE
		?>
		
</table><br />
<?php echo("Total Jenis Item = $item"); ?>
<?php //echo("<br/>Total Jumlah Obat = $total_item"); ?>

<br /><br /><br />

Apotek TBS<br /><br /><br /><br />---------------------
</font>
