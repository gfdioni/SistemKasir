<?php
include("../koneksi.php");

$pilihan        = $_GET['pilihan'];
$tahun            = $_GET['tahun'];
$bulan_angka    = $_GET['bulan_angka'];

$pil1='pembelian';
$pil2='penjualan';
$pil3='pengiriman';

if ($pilihan==$pil1) {
    echo("Laporan Pembelian Jumlah Detail Obat Periode <font color='red'>$bulan_angka $tahun</font><br/><br/>");
    echo("
			<table border='1'>
				<tr align='center' bgcolor='cyan'>
					<td width='150'>Kode Obat</td>
					<td width='300'>Nama Obat</td>
					<td width='100'>Satuan</td>	
					<td width='150'>Jumlah Yang Dibeli</td>	
				<tr>
	");
    $query="select dp.kode_obat, o.nama_obat, o.satuan, sum(dp.jumlah) AS 'jum' from obat o, detail_pembelian dp, pembelian p
	where dp.no_faktur = p.no_faktur AND o.kode_obat = dp.kode_obat AND p.tgl_beli like '%$tahun-$bulan_angka%'
	group by dp.kode_obat";
    $eksekusi=mysql_query($query);
    while ($data=mysql_fetch_row($eksekusi)) {
        echo("	
				<tr align='center'> 
					<td>$data[0]</td> 
					<td>$data[1]</td> 
					<td>$data[2]</td> 
					<td>$data[3]</td>	
				</tr>
		");
    } //END OF WHILE
        echo("</table>");
    // MENGHITUNG TOTAL PEMBELIAN PERIODE INI DALAM RUPIAH
    $total_harga="SELECT SUM(TOTAL_HARGA) FROM PEMBELIAN WHERE TGL_BELI LIKE '%$tahun-$bulan_angka%'";
    $hitung=mysql_query($total_harga);
    while ($data=mysql_fetch_row($hitung)) {
        //echo("<br/>Total Pembelian Obat Periode ini adalah = Rp $data[0]");
        echo("<br/>Total Pembelian Obat Periode ini adalah = Rp. ".number_format($data[0], 0, ",", ".").",00 ");
        //echo"Rp. ".number_format($data[0],0,",",".").",00";
    }
    // SELESAI MENGHITUNG
    echo("<br/>");
} //tutup if di LINE if($pilihan==$pil1){

elseif ($pilihan==$pil2) {
    echo("Laporan Penjualan Jumlah Detail Obat Periode <font color='red'>$bulan_angka $tahun</font><br/><br/>");
    echo("
			<table border='1'>
				<tr align='center' bgcolor='cyan'>
					<td width='150'>Kode Obat</td>
					<td width='300'>Nama Obat</td>
					<td width='100'>Satuan</td>
					<td width='150'>Jumlah Yang Dijual</td>
				<tr>
	");
    $query="select o.kode_obat, o.nama_obat, o.satuan, sum(dp.jumlah) from obat o, detail_penjualan dp, penjualan p, batch b
	where dp.no_struk = p.no_struk AND dp.no_batch = b.no_batch AND b.kode_obat = o.kode_obat AND p.tgl_jual like '%$tahun-$bulan_angka%'
	group by o.kode_obat";
    $eksekusi=mysql_query($query);
    while ($data=mysql_fetch_row($eksekusi)) {
        echo("	
				<tr align='center'> 
					<td>$data[0]</td> 
					<td>$data[1]</td> 
					<td>$data[2]</td> 
					<td>$data[3]</td>
				</tr>
		");
    } //END OF WHILE
        echo("</table>");
        
    // MENGHITUNG TOTAL PENJUALAN PERIODE INI DALAM RUPIAH
    $total_harga="SELECT SUM(dp.TOTAL_HARGA) FROM DETAIL_PENJUALAN DP, PENJUALAN p WHERE p.no_struk = dp.no_struk AND p.TGL_JUAL LIKE  '%$tahun-$bulan_angka%'";
    $hitung=mysql_query($total_harga);
    while ($data=mysql_fetch_row($hitung)) {
        //echo("<br/>Total Penjualan Obat Periode ini adalah = Rp $data[0]");
        echo("<br/>Total Penjualan Obat Periode ini adalah = Rp. ".number_format($data[0], 0, ",", ".").",00 ");
        //echo"Rp. ".number_format($data[0],0,",",".").",00";
    }
    // SELESAI MENGHITUNG
    echo("<br/>");
} //tutup else if di LINE else if($pilihan==$pil2{

elseif ($pilihan==$pil3) {
    echo("Laporan Pengiriman Jumlah Obat Periode <font color='red'>$bulan $tahun</font><br/><br/>");
    echo("
			<table border='1'>
				<tr align='center' bgcolor='cyan'>
					<td width='150'>Kode Obat</td>
					<td width='350'>Nama Obat</td>
					<td width='150'>Jumlah Yang Dipesan</td>
					<td width='150'>Jumlah Yang Dibeli</td>
					<td width='150'>Jumlah Tidak Diterima</td>
				<tr>
	");
    $query="select detail_pemesanan.kode_obat,obat.nama_obat, sum(detail_pemesanan.jumlah), sum(detail_pembelian.jumlah), sum(detail_pemesanan.jumlah) - sum(detail_pembelian.jumlah) from obat, detail_pemesanan,pemesanan,detail_pembelian,pembelian,detail_faktur,faktur where detail_pemesanan.kode_obat = obat.kode_obat AND pemesanan.tgl_pesan like '%$tahun-$bulan_angka%' AND pembelian.tgl_beli like '%$tahun-$bulan_angka%' AND faktur.tgl_faktur like '%$tahun-$bulan_angka%' AND faktur.id_pesan = pemesanan.id_pesan AND pembelian.no_faktur = faktur.no_faktur AND pemesanan.id_pesan = detail_pemesanan.id_pesan AND faktur.no_faktur = detail_faktur.no_faktur AND pembelian.no_faktur = detail_pembelian.no_faktur AND detail_pemesanan.kode_obat = detail_faktur.kode_obat AND detail_faktur.kode_obat = detail_pembelian.kode_obat group by detail_faktur.kode_obat order by obat.nama_obat asc";
    $eksekusi=mysql_query($query);
    while ($data=mysql_fetch_row($eksekusi)) {
        echo("	
				<tr align='center'> 
					<td>$data[0]</td> 
					<td>$data[1]</td> 
					<td>$data[2]</td> 
					<td>$data[3]</td>
					<td>$data[4]</td>
				</tr>
		");
    } //END OF WHILE
        echo("</table>");
    echo("<br/>");
} //tutup else if di LINE else if($pilihan==$pil3{
