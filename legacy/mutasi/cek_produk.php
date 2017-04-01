<h5>Halaman Cek Produk<br />
</h5> 

<script language="javascript" type="text/javascript">
function validate_form ()
{
    valid = true;
	
	if ( document.cek.cari.value == "" )
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
//ini_set('max_execution_time', 1000);
?>

<form method="post" action="?page=cek_produk" name="cek" onsubmit="return validate_form()" >
Masukkan Nama Obat : <input type="text" name="cari"  autofocus autocomplete="off" /> <input type="submit" name="submit" value="CARI" /><br /><br />
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
		<td width="100">No Rak Etalase</td>
	</tr>
	<?php
	$cari=$_POST['cari'];
	$counter = 1;
	$sql 	= "select o.kode_obat, o.nama_obat, o.satuan, sum(b.stok), o.harga,o.harga_langganan,o.rak from obat o, batch b
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
		<td width="100" align="center"><?php echo number_format($hasil[4],0,",","."); ?></td>
		<td width="100" align="center"><?php echo number_format($hasil[5],0,",","."); ?></td>
		<td width="100" align="center"><?php echo $hasil[3]; ?></td>
		<td width="100" align="center"><?php echo $hasilqueryetalase; ?></td>
		<td width="100" align="center"><?php echo $hasilqueryetalase+$hasil[3]; ?></td>
		<td width="100" align="center"><?php echo $hasil[6]; ?></td>
	</tr>
	<?php
	$counter++;
	}
	?>
</table>

<?php
} //tutup if(isset($_POST['cari']){
?>
	 
