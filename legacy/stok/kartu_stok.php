<h5>Laporan Kartu Stok Masuk</h5>

<head>
<script language='JavaScript'>var ajaxRequest;
function getAjax() //fungsi untuk mengecek AJAX pada browser
{
try
{

ajaxRequest = new XMLHttpRequest();
}
catch (e)
{
try
{
ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
}

catch (e)
{
try
{
ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{

alert("Your browser broke!");
return false;
}
}
}
}

function autoComplete() //fungsi menangkap input search dan menampilkan hasil search
{

getAjax();
input = document.getElementById('inputan').value;

if (input == "")
{
document.getElementById("hasil").innerHTML = "";
}

else
{
ajaxRequest.open("GET","stok/kartu_stok_ambil_kode.php?input="+input);
ajaxRequest.onreadystatechange = function()
{
document.getElementById("hasil").innerHTML = ajaxRequest.responseText;

}
ajaxRequest.send(null);
}
}

function autoInsert(nama) //fungsi mengisi input text dengan hasil pencarian yang dipilih
{
document.getElementById("inputan").value = nama;
document.getElementById("hasil").innerHTML = "";

}
</script>
</head>

<script language="javascript" type="text/javascript">
function validate_form()
{
	valid = true;
	
	if ( document.kartu.periode_awal.value == "" )
	{
        alert ( "Input Periode awal!" );
        valid = false;
    }
	if ( document.kartu.periode_akhir.value == "" )
    {
        alert ( "Input Periode akhir!" );
        valid = false;
    }
	if ( document.kartu.caridata.value == "" )
    {
        alert ( "Input Kode Obat!" );
        valid = false;
    }
	
	 return valid;
}
</script>

<?php
include("koneksi.php");
?>

<form name="kartu" method="post" action="?page=kartu_stok" onsubmit="return validate_form();">
<center>
<h4>INPUT PERIODE DAN NAMA OBAT</h4><br /><br />
<table border="0">
<tr>
	<td width="100">Dari</td>
	<td>:</td>
	<td><input type="text" name="periode_awal" /><a href="javascript:void(0)" onClick=												"if(self.gfPop)gfPop.fPopCalendar(document.kartu.periode_awal);return false;" ><img name="popcal" align="absmiddle" style="border:none" src="./calender/calender.jpeg" width="34" height="29" border="0" alt=""></a> </td>
</tr>
<tr>
	<td>Sampai</td>
	<td>:</td>
	<td><input type="text" name="periode_akhir" /><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.kartu.periode_akhir);return false;" ><img name="popcal" align="absmiddle" style="border:none" src="./calender/calender.jpeg" width="34" height="29" border="0" alt=""></a> </td>
</tr>
<tr>
	<td>Nama Obat</td>
	<td>:</td>
	<td><input type='text' name="kode_obat" onKeyUp="autoComplete();" id='inputan' autocomplete="off" />
	<div id='hasil'></div> <!– menampilkan hasil search –></td>		
</tr>
<tr>
	<td colspan="3" align="center"><input type="submit" name="cari" value="CARI"></td>
</tr>
</table>
</center>
</form>

<?php
if(isset($_POST['cari'])){

$awal = @$_POST['periode_awal'];
$akhir = @$_POST['periode_akhir'];
$cari = @$_POST['kode_obat'];

$queryobat = "select nama_obat from obat where kode_obat = '$cari'";
$eks_queryobat = mysql_query($queryobat);
$hasil_eks_queryobat = mysql_fetch_array($eks_queryobat);

?>
<br />Kartu Stok Produk = <h5> <?php echo "$hasil_eks_queryobat[0] (kode $cari)"; ?></h5>

<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width="30">No</td>
		<td width="100">Kode Obat</td>
		<td width="300">Nama Obat</td>
		<td width="100">Satuan</td>
		<td width="50">Jumlah Beli</td>
		<td width="50">Expired</td>
		<td width="100">Harga Beli</td>
		<td width="50">Diskon 1(%)</td>
		<td width="50">Diskon 2(%)</td>
		<td width="50">Diskon 3(%)</td>
		<td width="50">Diskon 4(%)</td>
		<td width="100">Tgl Obat Masuk</td>
		<td width="100">No Faktur</td>
		<td width="200">PBF</td>
	</tr>
<?php
$query="select o.kode_obat, o.nama_obat, o.satuan, df.jumlah as jumlah_beli, df.harga, df.diskon1, df.diskon2, df.diskon3, df.diskon4, df.tgl_obat_masuk,f.no_faktur, p.nama_pbf, df.expired
from obat o, detail_faktur df, pbf p, faktur f, pemesanan pes
where o.kode_obat = df.kode_obat and
df.no_faktur = f.no_faktur and
f.id_pesan = pes.id_pesan and
p.kode_pbf = pes.kode_pbf and
df.tgl_obat_masuk between '$awal' and '$akhir' and
o.kode_obat='$cari'
order by df.tgl_obat_masuk desc";

$tampil_data=mysql_query($query);
$counter=1;
$item=mysql_num_rows($tampil_data);
while($data=mysql_fetch_array($tampil_data)){
	echo("<tr align='center'> 
			<td>$counter</td>
			<td>$data[0]</td> 
			<td>$data[1]</td> 
			<td>$data[2]</td> 
			<td>$data[3]</td>");?>
			<td><?php echo date('d-m-Y', strtotime($data[12])); ?></td>
			<td><?php echo number_format($data[4],0,",","."); ?></td> <?php echo("
			<td>$data[5]</td>
			<td>$data[6]</td>
			<td>$data[7]</td>
			<td>$data[8]</td>"); ?>
			<td><?php echo date('d-m-Y', strtotime($data[9])); ?></td> <?php echo("
			<td>$data[10]</td>
			<td>$data[11]</td>
		</tr>
		");
		$counter++;
}
if($item==0){
	echo ("Data Obat ini tidak tersedia");
}
?>
</table>

<?php
} //tutup if(isset($_POST['cari'])){
?>



<br /><hr />

<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

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
	<a class="btnPrint" href='iframes/print_kartu_stok.php?cari=<?php echo $cari;?>&awal=<?php echo $awal;?>&akhir=<?php echo $akhir;?>'>PRINT!</a>
	</font></center>
