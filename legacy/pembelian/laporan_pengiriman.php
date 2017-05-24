<?php
include("koneksi.php");
$no_faktur=@$_GET['no_faktur'];
$ppn1=@$_GET['ppn1'];
?>

<h5>Laporan Pengiriman Obat Faktur Nomor <?php echo $no_faktur;?></h5>

<?php
    if ($no_faktur != "") {
        $sql = "select * from pembelian where no_faktur = '$no_faktur'";
        $eks = mysql_query($sql);
        $hasil = mysql_fetch_array($eks);
        
        $sql2 = "select pbf.nama_pbf,faktur.diskon_ekstra,faktur.ppn from pbf, pemesanan, faktur, pembelian where pemesanan.kode_pbf = pbf.kode_pbf AND faktur.id_pesan = pemesanan.id_pesan AND pembelian.no_faktur = faktur.no_faktur AND pembelian.no_faktur = '$no_faktur'";
        $eks2 = mysql_query($sql2);
        $hasil2 = mysql_fetch_array($eks2); ?>
		<table>
			<tr>
				<td width="100">No Faktur</td>
				<td>:</td>
				<td><?php echo $hasil[0]; ?></td>
			</tr>
			<tr>
				<td>PBF</td>
				<td>:</td>
				<td><b><?php echo $hasil2[0]; ?></b></td>
			</tr>
			<tr>
				<td>Tgl Masuk</td>
				<td>:</td>
				<td><?php echo date('d-m-Y', strtotime($hasil[1])); ?></td>
			</tr>
			<tr>
				<td>Tgl JT </td>
				<td>:</td>
				<td><?php echo date('d-m-Y', strtotime($hasil[3])); ?></td>
			</tr>
			<tr>
				<td>Diskon Ekstra</td>
				<td>:</td>
				<td><?php echo $hasil2[1]; ?> %</td>
			</tr>
			<tr>
				<td>PPN</td>
				<td>:</td>
				<td><?php echo $hasil2[2]; ?> %</td>
			</tr>
			<tr>
				<td>Total Harga</td>
				<td>:</td>
				<td><b><?php echo"Rp. ".number_format($hasil[2], 0, ",", ".").",00"; ?></b></td>
			</tr>
		</table>
		<br />
		<table border="1">
			<tr bgcolor="#00CCFF" align="center">
				<td width="30">No</td>
				<td width="130">Kode Obat</td>
				<td width="400">Nama Obat</td>
				<td width="50">Satuan</td>
				<td width="80">Expired</td>
				<td width="50">Jumlah</td>
				<td width="50">Harga Satuan</td>
				<td width="50">Diskon 1(%)</td>
				<td width="50">Diskon 2(%)</td>
				<td width="50">Diskon 3(%)</td>
				<td width="50">Diskon 4(%)</td>
			</tr>
		<?php
        //$sql = "select distinct(detail_pemesanan.kode_obat),obat.nama_obat, detail_pemesanan.jumlah as jumlah_pesan, detail_pembelian.jumlah as jumlah_beli, detail_pemesanan.jumlah - detail_pembelian.jumlah as jumlah_sisa, (detail_pembelian.jumlah * detail_pembelian.harga) - ((detail_pembelian.jumlah * detail_pembelian.harga)*(detail_pembelian.diskon/100)) as subtotal from obat, detail_pemesanan, detail_faktur, detail_pembelian, faktur, pemesanan where detail_pemesanan.kode_obat = obat.kode_obat AND detail_pembelian.kode_obat = detail_pemesanan.kode_obat AND detail_pembelian.no_faktur = detail_faktur.no_faktur AND detail_faktur.no_faktur = faktur.no_faktur AND faktur.id_pesan = pemesanan.id_pesan AND faktur.no_faktur = '$no_faktur' group by obat.kode_obat";
        $sql = "select no_faktur, o.nama_obat, o.satuan, df.kode_obat, no_batch, expired, jumlah, df.harga, diskon1, diskon2, diskon3, diskon4, tgl_obat_masuk, jam_obat_masuk 
		from detail_faktur df, obat o 
		where df.kode_obat = o.kode_obat AND no_faktur='$no_faktur'";
        $eks = mysql_query($sql);
        $no=1;
        while ($row = mysql_fetch_array($eks)) {
            ?>
			<tr align="center">
				<td width="30"><?php echo $no; ?></td>
				<td width="130"><?php echo $row[3]; ?></td> 
				<td width="400"><?php echo $row[1]; ?></td>
				<td width="50"><?php echo $row[2]; ?></td>
				<td width="80"><?php echo date('d-m-Y', strtotime($row[5])); ?></td>
				<td width="50"><?php echo $row[6]; ?></td>
				<td width="50"><?php echo number_format($row[7], 0, ",", "."); ?></td>
				<td width="50"><?php echo $row[8]; ?></td>
				<td width="50"><?php echo $row[9]; ?></td>
				<td width="50"><?php echo $row[10]; ?></td>
				<td width="50"><?php echo $row[11]; ?></td>
			</tr>
		<?php
        $no++;
        } // tutup while?>
		</table>
		<br />
		
	<?php

    } // tutup if di LINE if($no_faktur != ""){
    ?>
<br /><hr /><br />
<a href="?page=faktur_insert">Kembali Ke Halaman Pembelian</a>