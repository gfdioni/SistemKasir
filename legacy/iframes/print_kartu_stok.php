<?php
include("../koneksi.php");

$cari	 	= $_GET['cari'];
$awal		= $_GET['awal'];
$akhir		= $_GET['akhir'];

$queryobat = "select nama_obat from obat where kode_obat = '$cari'";
$eks_queryobat = mysql_query($queryobat);
$hasil_eks_queryobat = mysql_fetch_array($eks_queryobat);

?>
<br />Kartu Stok Produk = <h5> <?php echo "$hasil_eks_queryobat[0] (kode $cari)"; ?></h5>

<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width="30">No</td>
		<td width="300">Nama Obat</td>
		<td width="100">Satuan</td>
		<td width="50">Jumlah Beli</td>
		<td width="50">Expired</td>
		<td width="100">Harga Beli</td>
		<td width="50">Diskon 1(%)</td>
		<td width="50">Diskon 2(%)</td>
		<td width="50">Diskon 3(%)</td>
		<td width="50">Diskon 4(%)</td>
		<td width="100">Tgl Obat Masuk</td>
		<td width="100">No Faktur</td>
		<td width="200">PBF</td>
	</tr>
<?php
$query="select o.kode_obat, o.nama_obat, o.satuan, df.jumlah as jumlah_beli, df.harga, df.diskon1, df.diskon2, df.diskon3, df.diskon4, df.tgl_obat_masuk,f.no_faktur, p.nama_pbf, df.expired
from obat o, detail_faktur df, pbf p, faktur f, pemesanan pes
where o.kode_obat = df.kode_obat and
df.no_faktur = f.no_faktur and
f.id_pesan = pes.id_pesan and
p.kode_pbf = pes.kode_pbf and
df.tgl_obat_masuk between '$awal' and '$akhir' and
o.kode_obat='$cari'
order by df.tgl_obat_masuk desc";

$tampil_data=mysql_query($query);
$counter=1;
$item=mysql_num_rows($tampil_data);
while($data=mysql_fetch_array($tampil_data)){
	echo("<tr align='center'> 
			<td>$counter</td>
			<td>$data[1]</td> 
			<td>$data[2]</td> 
			<td>$data[3]</td>");?>
			<td><?php echo date('d-m-Y', strtotime($data[12])); ?></td>
			<td><?php echo number_format($data[4],0,",","."); ?></td> <?php echo("
			<td>$data[5]</td>
			<td>$data[6]</td>
			<td>$data[7]</td>
			<td>$data[8]</td>"); ?>
			<td><?php echo date('d-m-Y', strtotime($data[9])); ?></td> <?php echo("
			<td>$data[10]</td>
			<td>$data[11]</td>
		</tr>
		");
		$counter++;
}
if($item==0){
	echo ("Data Obat ini tidak tersedia");
}
?>
</table>