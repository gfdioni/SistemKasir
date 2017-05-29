<h5>Halaman Pembayaran</h5>

<?php
include("../koneksi.php");
$no_faktur=@$_GET['no_faktur'];
$tgl = date('d-m-Y');

echo("
<center><h4>Tagihan Faktur Yang Belum Dibayar Hari Ini ($tgl)</h4></center>
<table border='1'>
<tr align='center' bgcolor='yellow'>
	<td width='40'> No </td>
	<td width='100'>No Faktur</td>
	<td width='150'>Tanggal Beli</td>
	<td width='150'>Total Harga(Rp)</td>
	<td width='150'>Tanggal Jth Tempo</td>
	<td width='350'>PBF</td>
</tr>
");

$query="select distinct(pembelian.no_faktur), tgl_beli, pembelian.total_harga, pembelian.tgl_jatuh_tempo,pbf.nama_pbf from pembelian,faktur,pembayaran,pemesanan,pbf 
where pembelian.no_faktur not in (select pembayaran.no_faktur from pembayaran) AND pembelian.no_faktur = faktur.no_faktur AND faktur.id_pesan=pemesanan.id_pesan AND pbf.kode_pbf=pemesanan.kode_pbf and pembelian.tgl_jatuh_tempo = curdate() order by tgl_beli ASC";
$tampil_data=mysql_query($query);
$i=1;
while ($data=mysql_fetch_row($tampil_data)) {
    echo("<tr align='center'>
			<td>$i</td>
			<td>$data[0]</td>"); ?>
			<td><?php echo date('d-m-Y', strtotime($data[1])); ?> </td><?php echo("
			<td>Rp. ".number_format($data[2], 0, ',', '.').",00 </td> "); ?>
			<td><?php echo date('d-m-Y', strtotime($data[3])); ?></td> 
			<td><?php echo $data[4]; ?> </td>
		  </tr>
		<?php
        $i++;
}
?>
</table>
<br /><br />