<?php
include "../koneksi.php";

//untuk export ke excel
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename= laporan.xls"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

$pilihan=@$_GET['pilihan'];

$bulan=@$_GET['bulan'];
if($bulan=='Januari'){
	$bulan_angka='01';
}
else if($bulan=='Februari'){
	$bulan_angka='02';
}
else if($bulan=='Maret'){
	$bulan_angka='03';
}
else if($bulan=='April'){
	$bulan_angka='04';
}
else if($bulan=='Mei'){
	$bulan_angka='05';
}
else if($bulan=='Juni'){
	$bulan_angka='06';
}
else if($bulan=='Juli'){
	$bulan_angka='07';
}
else if($bulan=='Agustus'){
	$bulan_angka='08';
}
else if($bulan=='September'){
	$bulan_angka='09';
}
else if($bulan=='Oktober'){
	$bulan_angka='10';
}
else if($bulan=='November'){
	$bulan_angka='11';
}
else if($bulan=='Desember'){
	$bulan_angka='12';
}

$tahun=@$_GET['tahun'];
$pil1='pembelian';
$pil2='penjualan';

/*if($pilihan==$pil1){
	echo("<h3>Laporan Pembelian Obat Periode <font color='red'>$bulan $tahun</font><br/><br/>");
	echo("
			<table border='1'>
				<tr align='center'>
					<td width='150'>No Faktur</td>
					<td width='150'>Tanggal Beli</td>
					<td width='150'>Total Harga</td>
					<td width='200'>Tanggal Jatuh Tempo</td>
					<td width='150'>Karyawan</td>
				<tr>
	");
	$query="SELECT * FROM PEMBELIAN WHERE TGL_BELI LIKE '%$tahun-$bulan_angka%' ORDER BY TGl_BELI";
	$eksekusi=mysql_query($query);
	while($data=mysql_fetch_row($eksekusi)){
		echo("	
				<tr align='center'> 
					<td>$data[1]</td> 
					<td>$data[2]</td> 
					<td>$data[3]</td> 
					<td>$data[4]</td>
					<td>$data[5]</td> 
		  		</tr>
		");
	} //END OF WHILE
		echo("</table>");
		
	// MENGHITUNG TOTAL PEMBELIAN PERIODE INI DALAM RUPIAH
	$total_harga="SELECT SUM(TOTAL_HARGA) FROM PEMBELIAN WHERE TGL_BELI LIKE '%$tahun-$bulan_angka%'";
	$hitung=mysql_query($total_harga);
	while($data=mysql_fetch_row($hitung)){
		echo("<h3>Total Pembelian Obat Periode ini adalah = Rp $data[0]</h3>"); 
	}
	// SELESAI MENGHITUNG
} //END OF PIL 1
*/

if($pilihan==$pil1){
	echo("<h4>Laporan Pembelian Jumlah Detail Obat Periode <font color='red'>$bulan $tahun</font></h4>");
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
	while($data=mysql_fetch_row($eksekusi)){
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
	while($data=mysql_fetch_row($hitung)){
		echo("<h4>Total Pembelian Obat Periode ini adalah = Rp $data[0]</h4>"); 
	}
	// SELESAI MENGHITUNG
	echo("<br/>");
} //END OF PIL 2

/*
else if($pilihan==$pil3){
	echo("<h3>Laporan Penjualan Obat Periode <font color='red'>$bulan $tahun</font><br/><br/>");
	echo("
			<table border='1'>
				<tr align='center'>
					<td width='150'>No Struk</td>
					<td width='150'>Tanggal Jual</td>
					<td width='150'>Kasir</td>
					<td width='150'>Total_harga</td>
				<tr>
	");
	$query="select p.no_struk, tgl_jual, username AS 'kasir', sum(total_harga) AS 'total' from penjualan p, detail_penjualan dp
	where p.no_struk = dp.no_struk AND p.tgl_jual like '%$tahun-$bulan_angka%'
	group by p.no_struk
	order by p.no_struk";
	$eksekusi=mysql_query($query);
	while($data=mysql_fetch_row($eksekusi)){
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
	while($data=mysql_fetch_row($hitung)){
		echo("<h3>Total Penjualan Obat Periode ini adalah = Rp $data[0]</h3>"); 
	}
	// SELESAI MENGHITUNG
} //END OF PIL 3
*/

else{
	echo("<h4>Laporan Penjualan Jumlah Detail Obat Periode <font color='red'>$bulan $tahun</font></h4>");
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
	while($data=mysql_fetch_row($eksekusi)){
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
	while($data=mysql_fetch_row($hitung)){
		echo("<h4>Total Penjualan Obat Periode ini adalah = Rp $data[0]</h4>"); 
	}
	// SELESAI MENGHITUNG
	echo("<br/>");
} //END OF PIL 4
?>