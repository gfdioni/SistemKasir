<h5>Halaman Mutasi Produk</h5> 

<script language="javascript" type="text/javascript">
function validate_form ()
{
    valid = true;
	
	if ( document.mutasi.cari.value == "" )
    {
        alert ( "kode atau nama obat belum diisi." );
        valid = false;
    }
	
    return valid;
}
</script>

<script language="JavaScript">
	function bukawindow(){
	win1 = window.open('mutasi/mutasi_form.php', 'newwindow', config='height=140, width=280, left=10, top=350, toolbar=no, scrollbars=yes, resizable=no')
	win1.focus();
	}
</script>

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);
$username=@$_SESSION['username'];
?>

<form method="post" action="?page=mutasi">
	<input type="submit" name="mulai" value="Mulai Sesi Mutasi" /> <input type="submit" name="akhir" value="Akhiri Sesi Mutasi" /><br /><br />
</form>
<?php
if(isset($_POST['mulai'])){
	$query_mulai = "insert into mutasi value ('',now(),'$username')";
	mysql_query($query_mulai);?>
	<script language="javascript">
			alert('Sesi Mutasi Dimulai');
			document.location='index.php?page=mutasi';
	</script>
	<?php
}
if(isset($_POST['akhir'])){
	$query_akhir1 = "delete from detail_mutasi";
	mysql_query($query_akhir1);
	$query_akhir2 = "delete from mutasi";
	mysql_query($query_akhir2);?>
	<script language="javascript">
			alert('Sesi Mutasi Berakhir');
			document.location='index.php?page=mutasi';
	</script>
	<?php
}
?>


<form method="post" action="?page=mutasi" name="mutasi" onsubmit="return validate_form()">
Masukkan Nama atau Scan Barcode Obat : <input type="text" name="cari"  autofocus autocomplete="off" /> <input type="submit" name="submit" value="CARI" /><br /><br />
</form>

<?php 
if(isset($_POST['cari'])){?>
<table border="1">
	<tr bgcolor="#6666FF" align="center">
		<td width="50">No</td>
		<td width="130">Kode Obat</td>
		<td width="400">Nama Obat</td>
		<td width="100">Satuan</td>
		<td width="100">Harga</td>
		<td width="100">Harga Langganan</td>
		<td width="100">Stok Di Gudang</td>
		<td width="100">Stok Di Etalase</td>
		<td width="100">Stok Total</td>
		<td width="50">Mutasikan</td>
	</tr>
	<?php
	$cari=$_POST['cari'];
	$counter = 1;
	$sql 	= "select o.kode_obat, o.nama_obat, o.satuan, sum(b.stok), o.harga, o.harga_langganan from obat o, batch b
			where o.kode_obat = b.kode_obat
			and (o.nama_obat like '%$cari%' or o.kode_obat like '%$cari%')
			group by o.kode_obat
			order by o.nama_obat asc";
	$eks 	= mysql_query($sql);
	while($hasil=mysql_fetch_array($eks)){
		$kode_obat=$hasil['kode_obat'];
		$queryetalase = "select (sum(stok)) from etalase where kode_obat = '$kode_obat'";
		$eksqueryetalase = mysql_query($queryetalase);
		$ambilqueryetalase = mysql_fetch_row($eksqueryetalase);
		$hasilqueryetalase = $ambilqueryetalase[0];
	?>
	<tr>
		<td width="50" align="center"><?php echo $counter; ?></td>
		<td width="130"><?php echo $hasil[0]; ?></td>
		<td width="400"><?php echo $hasil[1]; ?></td>
		<td width="100" align="center"><?php echo $hasil[2]; ?></td>
		<td width="100" align="center"><?php echo $hasil[4]; ?></td>
		<td width="100" align="center"><?php echo $hasil[5]; ?></td>
		<td width="100" align="center"><?php echo $hasil[3]; ?></td>
		<td width="100" align="center"><?php echo $hasilqueryetalase; ?></td>
		<td width="100" align="center"><?php echo $hasilqueryetalase+$hasil[3]; ?></td>
		<td width="50" align="center"><a href="?page=mutasi_form&nama_obat=<?php echo $hasil[1];?>&kode_obat=<?php echo $hasil[0];?>&satuan=<?php echo $hasil[2];?>&stok=<?php echo $hasil[3];?>">mutasi</a></td>
	</tr>
	<?php
	$counter++;
	}
	?>
</table>

<?php
} //tutup if(isset($_POST['cari'])){
?>
<br />
<h5>List Yang Akan DiMutasi :</h5>
<table border="1">
	<tr bgcolor="cyan" align="center">
		<td width="50">No</td>
		<td width="150">Kode Obat</td>
		<td width="350">Nama</td>
		<td width="120">Satuan</td>
		<td width="120">Jumlah Mutasi</td>
	</tr>
	<?php
	$count 			= 1;
	$lihat_mutasi 	= "select * from detail_mutasi dm, obat o where dm.kode_obat = o.kode_obat";
	$eks_lihat 		= mysql_query($lihat_mutasi);
	while($hasil_lihat=mysql_fetch_array($eks_lihat)){?>
		<tr align="center">
			<td><?php echo $count;?></td>
			<td><?php echo $hasil_lihat[1]; ?></td>
			<td><?php echo $hasil_lihat[4]; ?></td>
			<td><?php echo $hasil_lihat[5]; ?></td>
			<td><?php echo $hasil_lihat[2]; ?></td>
		</tr>
	<?
	$count++;
	} // TUTUP while($hasil_lihat=mysql_fetch_array($eks_lihat)){
	?>
</table><br />

<!-------------------------------------------------------- SCRIPT UNTUK PRINT -------------------------------------------------------------------->

<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="jquery.printPage.js" type="text/javascript"></script>

<center><font size="+2">
<script>  
	$(document).ready(function(){
	$(".btnPrint").printPage();
	});
</script>
<a class="btnPrint" href='iframes/print_mutasi.php'>PRINT!</a>
</font></center>


	 
