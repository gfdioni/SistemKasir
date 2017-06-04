<h5>Halaman Histori Faktur</h5>

<script language="javascript" type="text/javascript">
function validate_form()
{
	valid = true;
	
	if ( document.histori.periode_awal.value == "" )
	{
        alert ( "Input Periode awal!" );
        valid = false;
    }
	if ( document.histori.periode_akhir.value == "" )
    {
        alert ( "Input Periode akhir!" );
        valid = false;
    }
	if ( document.histori.caridata.value == "" )
    {
        alert ( "Input Kode Obat!" );
        valid = false;
    }
	
	 return valid;
}
</script>

<?php
include("koneksi.php");
$no_faktur=@$_GET['no_faktur'];
?>

<form name="histori" method="post" action="?page=faktur_histori" onsubmit="return validate_form();">
<center>
<h4>INPUT PERIODE FAKTUR</h4><br /><br />
<table border="0">
	<tr>
		<td width="100">Dari</td>
		<td>:</td>
		<td><input type="text" name="periode_awal" /><a href="javascript:void(0)" onClick=												"if(self.gfPop)gfPop.fPopCalendar(document.histori.periode_awal);return false;" ><img name="popcal" align="absmiddle" style="border:none" src="./calender/calender.jpeg" width="34" height="29" border="0" alt=""></a> </td>
	</tr>
	<tr>
		<td>Sampai</td>
		<td>:</td>
		<td><input type="text" name="periode_akhir" /><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.histori.periode_akhir);return false;" ><img name="popcal" align="absmiddle" style="border:none" src="./calender/calender.jpeg" width="34" height="29" border="0" alt=""></a> </td>
	</tr>
	<tr>
		<td colspan="3" align="center"><input type="submit" name="cari" value="LIHAT FAKTUR"></td>
	</tr>
</table>
</center>
</form>

<?php
if (isset($_POST['cari'])) {
    $awal    = @$_POST['periode_awal'];
    $akhir    = @$_POST['periode_akhir'];
    
    $queryfaktur = "select * from faktur where tgl_faktur between '$awal' and '$akhir'";
    $eks_queryfaktur = mysql_query($queryfaktur);
    $hasil_eks_queryfaktur = mysql_fetch_array($eks_queryfaktur); ?>
	<br /><h5>Histori Faktur Dari Tanggal <font color="blue"><?php echo date('d-m-Y', strtotime($awal)); ?></font> sampai <font color="blue"><?php echo date('d-m-Y', strtotime($akhir)); ?></font></h5>
	<font color="#FF0000"><b>Klik No Faktur untuk melakukan Revisi</b></font>
	
	<table border='1'>
		<tr align='center' bgcolor='cyan'>
			<td width="50">ID Pesan</td>
			<td width="100">No Faktur</td>
			<td width="300">PBF</td>
			<td width="100">Tgl Faktur</td>
			<td width="150">Total harga</td>
			<td width="100">Tgl JT</td>
			<td width="80">Username</td>
			<td width="60">Diskon Ekstra(%)</td>
			<td width="60">PPN(%)</td>
		</tr>
	<?php
        $sql_faktur = "select * from faktur f, pemesanan p, pbf where f.id_pesan = p.id_pesan AND p.kode_pbf=pbf.kode_pbf AND f.tgl_faktur between '$awal' and '$akhir'";
    $eks_sql_faktur = mysql_query($sql_faktur);
    while ($data=mysql_fetch_array($eks_sql_faktur)) {
        ?>
		<tr align="center">
			<td><?php echo $data['id_pesan']; ?></td>
			<td><?php echo(" <a href='?page=faktur_histori&no_faktur=$data[1]'>$data[1]</a> "); ?></td> 
			<td><?php echo $data['nama_pbf']; ?></td>
			<td><?php echo date('d-m-Y', strtotime($data['tgl_faktur'])); ?></td>
			<td><?php echo "Rp ".number_format($data['total_harga'], 0, ",", ".").",00"; ?></td>
			<td><?php echo date('d-m-Y', strtotime($data['tgl_jatuh_tempo'])); ?></td>
			<td><?php echo $data['username']; ?></td>
			<td><?php echo $data['diskon_ekstra']; ?></td>
			<td><?php echo $data['ppn']; ?></td>	
		</tr>
		<?php

    }// tutup while($data=mysql_fetch_array($eks_sql_faktur))?>
	</table><?php

} //if(isset($_POST['cari')){

if ($no_faktur != "") {
    ?>
	<br /><hr />
	<br /><h5>Detail Faktur No = <?php echo $no_faktur; ?> </h5> <?php

} // tutup if($no_faktur != ""){

?>



<!-- -----------------------------------------------------KALENDER-------------------------------------------------- -->
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>