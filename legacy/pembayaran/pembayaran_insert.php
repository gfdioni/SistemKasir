<h5>Halaman Pembayaran</h5>

<?php
include("koneksi.php");
$no_faktur=@$_GET['no_faktur'];
$tgl = date('d-m-Y');

echo("
<center><h4>Tagihan Faktur Yang Belum Dibayar Hari Ini ($tgl)</h4></center><br/>
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
while($data=mysql_fetch_row($tampil_data)){
	echo("<tr align='center'>
			<td>$i</td>
			<td><a href=\"?page=pembayaran_insert&no_faktur=$data[0]\">$data[0]</a></td>"); ?>
			<td><?php echo date('d-m-Y', strtotime($data[1])); ?> </td><?php echo("
			<td>Rp. ".number_format($data[2],0,',','.').",00 </td> ");?>
			<td><?php echo date('d-m-Y', strtotime($data[3])); ?></td> 
			<td><?php echo $data[4];?> </td>
		  </tr>
		<?php
		$i++;
}
?>
</table>
<br /><br />

<?php
//ambil PBF
$q = "select nama_pbf from pbf, pemesanan p, faktur f where f.id_pesan=p.id_pesan AND p.kode_pbf = pbf.kode_pbf AND no_faktur='$no_faktur'";
$eksq = mysql_query($q);
$hasilq = mysql_fetch_array($eksq);
if($no_faktur != ""){
	$lihat = "select * from pembelian where no_faktur = '$no_faktur'";
	$ekslihat = mysql_query($lihat);
	$hasil = mysql_fetch_array($ekslihat);
	?>
	<strong>DETAIL PEMBELIAN OBAT</strong><br /><br />
	<table>
		<tr>
			<td width="100">No Faktur</td>
			<td>:</td>
			<td><?php echo $hasil['no_faktur']?></td>
		</tr>
		<tr>
			<td>PBF</td>
			<td>:</td>
			<td><b><?php echo $hasilq[0]?></b></td>
		</tr>
		<tr>
			<td>Tanggal Masuk </td>
			<td>:</td>
			<td><?php echo date('d-m-Y', strtotime($hasil['tgl_beli']));?></td>
		</tr>
		<tr>
			<td>Diskon Ekstra</td>
			<td>:</td>
			<td><?php echo $hasil['diskon_ekstra'];?> %</td>
		</tr>
		<tr>
			<td>PPN</td>
			<td>:</td>
			<td><?php echo $hasil['ppn'];?> %</td>
		</tr>
		<tr>
			<td>Total Harga</td>
			<td>:</td>
			<td><b><?php echo"Rp. ".number_format($hasil['total_harga'],0,",",".").",00"; ?></b></td>
		</tr>
		<tr>
			<td>Pembeli</td>
			<td>:</td>
			<td><?php echo $hasil[4]?></td>
		</tr>
	</table>
	<br />
	<table border="1">
		<tr align="center" bgcolor="#FF0000">
			<td>No</td>
			<td width="100">Kode Obat</td>
			<td width="400">Nama Obat</td>
			<td width="100">Satuan</td>
			<td width="70">Harga</td>
			<td width="80">No Batch</td>
			<td width="100">Expired</td>
			<td width="50">Jumlah Beli</td>
			<td width="50">Diskon 1(%)</td>
			<td width="50">Diskon 2(%)</td>
			<td width="50">Diskon 3(%)</td>
			<td width="50">Diskon 4(%)</td>
			
		</tr>
		<?php
		$sql = "select * from detail_pembelian, obat where obat.kode_obat = detail_pembelian.kode_obat AND no_faktur='$no_faktur'";
		$eks = mysql_query($sql);
		$i=1;
		while($row=mysql_fetch_array($eks)){
			$kode_obat	=$row['kode_obat'];
			$nama_obat	=$row['nama_obat'];
			$satuan		=$row['satuan'];
			$harga		=$row[5];
			$no_batch	=$row['no_batch'];
			$expired	=$row['expired'];
			$jumlah		=$row['jumlah'];
			$diskon1	=$row['diskon1'];
			$diskon2	=$row['diskon2'];
			$diskon3	=$row['diskon3'];
			$diskon4	=$row['diskon4'];		
		 ?>
		<tr align="center">
			<td><?php echo $i; ?></td>
			<td><?php echo $kode_obat; ?></td>
			<td><?php echo $nama_obat; ?></td>
			<td><?php echo $satuan; ?></td>
			<td><?php echo number_format($harga,0,",","."); ?></td>
			<td><?php echo $no_batch; ?></td>
			<td><?php echo date('d-m-Y', strtotime($expired)); ?></td>
			<td><?php echo $jumlah; ?></td>
			<td><?php echo $diskon1; ?></td>
			<td><?php echo $diskon2; ?></td>
			<td><?php echo $diskon3; ?></td>
			<td><?php echo $diskon4; ?></td>
		</tr>
		<?php
		$i++;
		} //tutup while di LINE 70
		?>
	</table>
	<form action="?page=pembayaran_insert" method="post">
	<input type="hidden" name="no_faktur" value="<?php echo $no_faktur; ?>" />
	<br /><input type="submit" name="confirm" value="CONFIRM" />	
<?php
} //tutup if di LINE if($id_pesan != ""){

	if(isset($_POST['confirm'])){
		$tgl_bayar = date('Y-m-d');
		$username = @$_SESSION['username'];
		$no_faktur = $_POST['no_faktur'];
		
		$sql = "insert into pembayaran (no_faktur,tgl_bayar,jam_bayar,username) values ('$no_faktur',curdate(),curtime(),'$username')";
		$eks = mysql_query($sql);
		if($sql){ ?>
			<script language="javascript">
				alert('Pembayaran dengan Nomer Faktur <?php echo $no_faktur; ?> telah dilakukan');
				document.location='index.php?page=pembayaran_insert';
			</script>
		<?php
		}		
	} // tutup if di line if(isset($_POST['confirm'])){ ?>
</form>

<!-------------------------------------------------------- SCRIPT UNTUK PRINT -------------------------------------------------------------------->

<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="jquery.printPage.js" type="text/javascript"></script>

<center><font size="+2">
<script>  
	$(document).ready(function(){
	$(".btnPrint").printPage();
	});
</script>
<a class="btnPrint" href='iframes/print_pembayaran.php'>PRINT!</a>
</font></center>
