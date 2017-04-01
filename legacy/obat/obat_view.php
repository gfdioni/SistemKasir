<h5>Halaman Obat</h5>

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);

//query untuk menghapus data obat
$kode_obat = @$_GET['kode_obat'];
if($kode_obat!=""){
	$query = "DELETE FROM OBAT WHERE kode_obat = '$kode_obat'";
	mysql_query($query);?>
	<script language="javascript">
		alert('Obat berhasil dihapus');
	</script>
	
	<?
}

?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
	conf = true;
	
	if (confirm("Hapus Data?")){
		<?php
		$sql = "select b.kode_obat from batch b, obat o where b.kode_obat = o.kode_obat AND b.kode_obat = '$kode_obat'";
		$eks = mysql_query($sql);
		$data = mysql_num_rows($eks);
			if ($data > 0){ ?>
				conf = false;
				alert("Tidak bisa menghapus data! Kode obat ini memiliki index child!");

			<?php
			}else if($data < 1){ ?>
				conf = true;
			<?php
			}
			?>
	}else {
		conf = false;
	}
	
	return conf;
}
</script> 

<form method="post" action="?page=obat_view">
Masukkan Nama Obat : <input type="text" name="cari" autocomplete="off" autofocus> <input type="submit" name="submit" value="Cari"><br>
</form>

<br /><h5>Data lengkap Obat</h5>
<b><a href="?page=obat_insert">Tambah data obat</a></b><br />

<?php
if(isset($_POST['cari'])){
	$cari=$_POST['cari'];
	echo("<table border='1'>");
	echo("<tr align='center' bgcolor='cyan'>
			<td width='50'>No</td>
			<td width='150'>Kode Obat</td>
			<td width='450'>Nama Obat</td>
			<td width='80'>Satuan</td>
			<td width='80'>Harga</td>
			<td width='80'>Harga Langganan</td>
			<td width='80'>Stok Minimum Gudang</td>
			<td width='80'>Stok Minimum Etalase</td>
			<td width='80'>No Rak Etalase</td>
			<td colspan='2'>Operasi</td></tr>
		 ");
		
	$query="SELECT * FROM OBAT where nama_obat like '%$cari%' OR kode_obat like '%$cari%' ORDER BY nama_obat";
	$tampil_data=mysql_query($query);
	$counter=1;
	while($data=mysql_fetch_row($tampil_data)){
		echo("<tr align='center'> 
				<td>$counter</td>
				<td>$data[0]</td> 
				<td align='left'>$data[1]</td> 
				<td>$data[2]</td> 
				<td align='right'>".number_format($data[3],0,",",".")."</td> 
				<td align='right'>".number_format($data[4],0,",",".")."</td> 
				<td>$data[5]</td> 
				<td>$data[6]</td>
				<td>$data[8]</td> 
				<td width='60'><a href=\"?page=obat_view&kode_obat=$data[0]\"  onClick='return confirmDelete();'>hapus</a></td> 
				<td width='60'><a href=\"?page=obat_update&kode_obat=$data[0]\">edit</a></td> </tr>
			");
			$counter++;
	}
	echo("</table>");
} //tutup if(isset($_POST['cari']))
?>

	<!--------------------------------------------------- SCRIPT UNTUK PRINT -------------------------------------------------------------------->
	<br />
	<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
	<script src="jquery.printPage.js" type="text/javascript"></script>
	
	<script>  
		$(document).ready(function(){
		$(".btnPrint").printPage();
		});
	</script>
	<center><font size="+2">
	<a class="btnPrint" href='iframes/print_obat.php?cari=<?php echo $cari;?>'>PRINT!</a>
	</font></center>
