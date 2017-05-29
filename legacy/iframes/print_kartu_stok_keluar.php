<?php
include("../koneksi.php");

$cari        = $_GET['cari'];
$awal        = $_GET['awal'];
$akhir        = $_GET['akhir'];

$queryobat = "select nama_obat from obat where kode_obat = '$cari'";
$eks_queryobat = mysql_query($queryobat);
$hasil_eks_queryobat = mysql_fetch_array($eks_queryobat);

?>
<br />Kartu Stok Keluar Produk = <h5> <?php echo "$hasil_eks_queryobat[0] (kode $cari)"; ?></h5>

<?php
// ==============  tampilkan jumlah selama periode yang dipilih  ========================

$jml="select o.kode_obat, o.nama_obat, o.satuan, p.tgl_jual, sum(dp.jumlah), dp.no_batch, b.expired, p.no_struk
from obat o, penjualan p, detail_penjualan dp, batch b
where dp.no_batch = b.no_batch and
b.kode_obat = o.kode_obat and
dp.no_struk = p.no_struk and
p.tgl_jual between '$awal' and '$akhir' and
o.kode_obat='$cari'
order by p.tgl_jual asc";

$ambil = mysql_query($jml);
$hasil = mysql_fetch_array($ambil);
$total = $hasil[4];
echo("Total item keluar selama periode <b>$awal</b> sampai <b>$akhir</b> adalah = <b> $total </b> satuan");


// =============== tampilkan data rinci obat yang keluar ===========================
?>
<br /><br />
<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width="30">No</td>
		<td width="350">Nama Obat</td>
		<td width="100">Satuan</td>
		<td width="100">Tgl Keluar</td>
		<td width="50">Jml Keluar</td>
		<td width="50">No Batch</td>
		<td width="100">Expired</td>
		<td width="100">No Struk</td>
	</tr>
<?php
$query="select o.kode_obat, o.nama_obat, o.satuan, p.tgl_jual, sum(dp.jumlah), dp.no_batch, b.expired, p.no_struk
from obat o, penjualan p, detail_penjualan dp, batch b
where dp.no_batch = b.no_batch and
b.kode_obat = o.kode_obat and
dp.no_struk = p.no_struk and
p.tgl_jual between '$awal' and '$akhir' and
o.kode_obat='$cari'
group by dp.no_batch,p.tgl_jual,p.no_struk
order by p.tgl_jual asc";

$tampil_data=mysql_query($query);
$counter=1;
$item=mysql_num_rows($tampil_data);
while ($data=mysql_fetch_array($tampil_data)) {
    echo("<tr align='center'> 
			<td>$counter</td>
			<td>$data[1]</td> 
			<td>$data[2]</td> 
			<td>$data[3]</td>
			<td><b>$data[4]</b></td>
			<td>$data[5]</td>
			<td>$data[6]</td>
			<td>$data[7]</td>
		</tr>
		");
    $counter++;
}
if ($item==0) {
    echo("Data Obat ini tidak tersedia");
}
?>
</table>
