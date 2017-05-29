<h5>Halaman Cetak Faktur Penjualan</h5>

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);
$no_struk = $_POST['no_struk'];
?>
 
<form name="jumlah" action="?page=penjualan_faktur" method="post">
<table border="0">
	<tr>
		<td>No Struk</td>
		<td>:</td>
		<td><input type="text" name="no_struk" autocomplete="off" autofocus/></td>
		<td><input type="submit" name="lihat" value="EDIT" /></td>
	</tr>
</table>
</form>

<?php
if(isset($_POST['lihat'])){ //script ini dilkukan saat button bernama "edit" ditekan ?>
	<br />
	
	<?php
	$query_penj			= "select * from penjualan where no_struk = '$no_struk'";
	$eks_query_penj		= mysql_query($query_penj);
	$ambil_query_penj	= mysql_fetch_array($eks_query_penj);
	$tgl	= $ambil_query_penj[1];
	$jam	= $ambil_query_penj[6];
	$user	= $ambil_query_penj[2];
	$total	= $ambil_query_penj[3];
	$dokter	= $ambil_query_penj[5];
	?>
	
	<h5>Faktur Penjualan</h5> 
	<table>
		<tr>
			<td colspan="3"><b>Bandung, <?php echo date('d-m-Y', strtotime($tgl)) ." / ". $jam; ?></b></td>
		</tr>
		<tr>
			<td>No Faktur</td>
			<td>:</td>
			<td><?php echo $no_struk; ?></td>
		</tr>
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td><?php echo $dokter ;?></td>
		</tr>
		<tr>
			<td>Operator</td>
			<td>:</td>
			<td><?php echo $user;?></td>
		</tr>
		<tr>
			<td>Total</td>
			<td>:</td>
			<td><b><?php echo"Rp. ".number_format($total,0,",",".").",00"; ?></b></td>
		</tr>
	</table>
	
	<table border="1">
		<tr bgcolor="#00CC00" align="center">
			<td width="30">No</td>
			<td width="100">Kode Barang</td>
			<td width="300">Nama Barang</td>
			<td width="100">Satuan</td>
			<td width="100">Harga</td>
			<td width="50">Qty</td>
			<td width="50">Diskon(%)</td>
			<td width="50">Diskon(Rp)</td>
			<td width="100">Total</td>
		</tr>
		<?php
		$no_struk=$_POST['no_struk'];
		$counter=1;
		$query="select o.kode_obat, left(o.nama_obat,28), o.satuan, dp.harga, dp.no_batch, dp.jumlah, dp.diskon, dp.total_harga, dp.id from obat o, batch b, 					
				detail_penjualan dp where o.kode_obat = b.kode_obat and dp.no_batch = b.no_batch and dp.no_struk = $no_struk order by o.nama_obat";
		$eks_query=mysql_query($query);
		while($data=mysql_fetch_row($eks_query)){ ?>
		<tr bgcolor="#99FFCC" align="center">
			<td><?php echo "$counter"; ?></td>
			<td><?php echo "$data[0]"; ?></td>
			<td><?php echo "$data[1]"; ?></td>
			<td><?php echo "$data[2]"; ?></td>
			<td><?php echo number_format($data[3],0,",","."); ?></td>
			<td><?php echo "$data[5]"; ?></td>
			<td><?php echo "$data[6]"; ?></td>
			<td><?php echo number_format(($data[3]*$data[5]*($data[6]/100)),0,",","."); ?></td>
			<td><?php echo number_format($data[7],0,",","."); ?></td>
		</tr>
		<?php
		$counter++;
		} //tutup while($data=mysql_fetch_row($eks_query){
		?>
	</table>
	
	<table border="0">
		<tr height="100" align="center">
			<td>Diterima Oleh</td>
			<td width="40"</td>
			<td>Diserahkan Oleh</td>
		</tr>
		<tr align="center">
			<td>(_______________)</td>
			<td></td>
			<td>(_______________)</td>
		</tr>
	</table>
	
	<!-------------------------------------------------------- SCRIPT UNTUK PRINT -------------------------------------------------------------------->
		
		<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
		<script src="jquery.printPage.js" type="text/javascript"></script>
		
		<br /><center><font size="+2">
		<script>  
			$(document).ready(function(){
			$(".btnPrint").printPage();
			});
		</script>
		<a class="btnPrint" href='iframes/print_faktur_penjualan.php?no_struk=<?php echo $no_struk; ?>'>PRINT!</a>
		</font></center>
	<?php	
} // tutup IF line if(isset($_POST['lihat'])
?>


