<?php
include("../koneksi.php");
$tgl = date('d-m-Y');
echo("<center><h5>Data obat yang sudah harus dipesan tanggal $tgl</h5></center>");
echo("<table border='1'>");
echo("<tr align='center' bgcolor='cyan'>
		<td width='30'>No</td>
		<td width='100'>Kode Obat</td>
		<td width='400'>Nama Obat</td>
		<td width='50'>Satuan</td>
		<td width='30'>Stok Min</td>
		<td width='30'>Stok Skrg</td>
	</tr>
	 ");

//menampilkan stok obat yang SUDAH lebih kecil dari STOK MINIMAL
$sql = "select batch.kode_obat,sum(stok) 'stok' from batch, obat where batch.kode_obat=obat.kode_obat group by batch.kode_obat order by obat.nama_obat ASC";    //menghitung jumlah stok di semua batch per KODE_OBAT
$query=mysql_query($sql);
$counter = 1;
while ($row=mysql_fetch_array($query)) {
    $kode_obat=$row['kode_obat'];
    $stok=$row['stok'];
    $sqlcek="select * from obat where kode_obat='$kode_obat' order by nama_obat ASC"; //mengambil kode_obat di tabel OBAT dan sesuai dengan kode_obat tabel BATCH
    $querycek=mysql_query($sqlcek);
    $rcek=mysql_fetch_array($querycek);
    $stok_min=$rcek['stok_min'];
    if ($stok<$stok_min) {
        echo("<tr align='center'>
			<td>$counter</td> 
			<td>".$rcek['kode_obat']."</td> 
			<td>$rcek[nama_obat]</td> 
			<td>$rcek[satuan]</td> 
			<td>$rcek[stok_min]</td> 
			<td>$row[stok]</td> 
			</tr>
		");
        $counter++;
    } //tutup if($stok<$stok_min){
} //tutup while($row=mysql_fetch_array($query)){
echo("</table>");
