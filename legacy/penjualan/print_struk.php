<?php
include("../koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);

$query = "select * from penjualan order by no_struk DESC";
$eks_query = mysql_query($query);
$hasil = mysql_fetch_array($eks_query);
    $no_struk = $hasil['no_struk'];
    $tgl = $hasil['tgl_jual'];
    $username = $hasil['username'];
    $bayar = $hasil['bayar'];
    $jam = $hasil['jam_jual'];
    
?>

APOTEK TBS<br />Komp. GBA 2 blok M2 no.19<br />022-7532003<br /><br />

<table border="0">
	<tr>
		<td>NoStruk</td>
		<td>:</td> 
		<td><?php echo $no_struk;?></td>
	</tr>
	<tr>
		<td>Kasir</td> 
		<td>:</td>
		<td><?php echo $username; ?></td>
	</tr>
	<tr>
		<td>Tgl / Jam</td>
		<td>:</td>
		<td><?php echo date('d-m-Y', strtotime($tgl)) ."/". $jam; ?></td>
	</tr>
</table>
<br />
<table border="0">
	<tr align="center">
		<td width="60">ITEM</td>
		<td width="30">PRICE</td>
		<td width="5">QTY</td>
		<td width="30">SUB</td>
	</tr>
	<?php
    $querystruk="select left(o.nama_obat,20) as nama_obat, dp.harga as harga, sum(dp.jumlah) as jumlah, sum(dp.total_harga) as total_harga from penjualan p, detail_penjualan dp, batch b, obat o where dp.no_struk=p.no_struk and dp.no_batch = b.no_batch and o.kode_obat=b.kode_obat AND p.no_struk='$no_struk' group by o.kode_obat";
    $eksekusi=mysql_query($querystruk);
    while ($row=mysql_fetch_array($eksekusi)) {
        $nama_obat=$row['nama_obat'];
        $jumlah=$row['jumlah'];
        $harga=$row['harga'];
        $total_harga=$row['total_harga'];

        $sub=$jumlah*$harga;
        
        $semua .= $nama_obat;
        $semua .= "
";
        $semua .= "        ".$harga."  x  ";
        $semua .= $jumlah." = ";
        $semua .= "      ".$sub;
        $semua .= "
"; ?>
		<tr>
			<td><?php echo $nama_obat; ?></td>
		</tr>
		<tr>
			<td align="center"><?php echo"".number_format($harga, 0, ",", ".").""; ?></td>
			<td>x</td>
			<td align="center"><?php echo $jumlah; ?></td>
			<td align="center"><?php echo"".number_format($total_harga, 0, ",", ".").""; ?></td>
		</tr>
		<?php
        $sqltotal = "select * from penjualan where no_struk='$no_struk'"; //digunakan untuk menampilkan total harga di struk
        $query=mysql_query($sqltotal);
        $row = mysql_fetch_array($query);
        $total_harga = $row['total_harga'];
    } //tutup while di LINE 52
        ?>
</table>
<br />
<table>
	<tr>
		<td>T O T A L</td> 
		<td>:</td> 
		<td><?php echo"Rp. ".number_format($total_harga, 0, ",", ".").",00"; ?></td>
	</tr>
	<tr>
		<td>C A S H  .</td> 
		<td>:</td> 
		<td><?php echo"Rp. ".number_format($bayar, 0, ",", ".").",00"; ?></td>
	</tr>
	<tr>
		<td>C H A N G E</td> 
		<td>:</td> 
		<td><?php echo"Rp. ".number_format($bayar-$total_harga, 0, ",", ".").",00"; ?></td>
		<?php $change = $bayar-$total_harga; ?>
	</tr>
</table>	
<?php
echo("<br/>Terima Kasih<br />Semoga Lekas Sembuh");
    
?>

<?php

$tampil_tgl      = date('d-m-Y', strtotime($tgl)) ."/". $jam;
$tampil_total = "Rp. ".number_format($total_harga, 0, ",", ".").",00";
$tampil_bayar = "Rp. ".number_format($bayar, 0, ",", ".").",00";
$tampil_change= "Rp. ".number_format($change, 0, ",", ".").",00";

$handle= printer_open("EPSON TM-U220 Receipt");
printer_set_option($handle, PRINTER_MODE, "RAW");
printer_start_doc($handle, "Menggunakan Printer PHP");
printer_start_page($handle);
//tuliskan huruf yang akan dicetak
        
$cetak ="
APOTEK TBS
Komp. GBA 2 blok M2 no.19
022-7532003

NoStruk	: $no_struk
Kasir	: $username
Tgl/Jam	: $tampil_tgl

ITEM	  PRICE   QTY	SUBTOTAL

$semua

T O T A L	:	$tampil_total
C A S H .	:	$tampil_bayar
C H A N G E	:	$tampil_change

Terima Kasih
Semoga Lekas Sembuh
";

echo $cetak;
printer_write($handle, $cetak);
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);
?>

<script language="javascript">
document.location='../index.php?page=tampilan_akhir';
</script>