<h5>HALAMAN PEMESANAN</h5>

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
ajaxRequest.open("GET","pemesanan/pemesanan_insert_ambil_kode.php?input="+input);
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
	var angka = /^[0-9]+$/;
	
	if ( document.pesan.jumlah.value == "" )
    {
        alert ( "Jumlah pesan belum diisi." );
        valid = false;
    }
	
	if ( document.pesan.jumlah.value == "0" )
    {
        alert ( "Jumlah pesan tidak boleh 0" );
        valid = false;
    }
	
	
	if ( !document.pesan.jumlah.value.match(angka) )
    {
       alert ( "Jumlah pesan harus angka." );
        valid = false;
    }
	
    return valid;
}
</script>

<?php
include("koneksi.php");
echo("Data obat yang sudah harus dipesan<br/><br/>");
echo("<table border='1'>");
echo("<tr align='center' bgcolor='cyan'>
		<td width='150'>Kode Obat</td>
		<td width='400'>Nama Obat</td>
		<td width='100'>Satuan</td>
		<td width='150'>Stok Min</td>
		<td width='150'>Stok sekarang</td>
	 ");

//menampilkan stok obat yang SUDAH lebih kecil dari STOK MINIMAL
$sql = "select kode_obat,sum(stok) 'stok' from batch group by kode_obat";	//menghitung jumlah stok di semua batch per KODE_OBAT
$query=mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$kode_obat=$row['kode_obat'];
	$stok=$row['stok'];
	$sqlcek="select * from obat where kode_obat='$kode_obat'"; //mengambil kode_obat di tabel OBAT dan sesuai dengan kode_obat tabel BATCH
	$querycek=mysql_query($sqlcek);
	$rcek=mysql_fetch_array($querycek);
	$stok_min=$rcek['stok_min'];
	if($stok<$stok_min){
		echo("<tr align='center'> 
			<td>".$rcek['kode_obat']."</td> 
			<td>$rcek[nama_obat]</td> 
			<td>$rcek[satuan]</td> 
			<td>$rcek[stok_min]</td> 
			<td>$row[stok]</td> 
		");
	}
}
echo("</table>");

$jumlah=@$_POST['jumlah'];
$kode_pbf = @$_POST['kode_pbf'];
?>

<br /><hr /><br /><marquee width="400"><font color="#3333FF" size="3">SILAHKAN MELAKUKAN PEMESANAN</font></marquee><br /><br />

<form action="" method="post" name="pesan" onSubmit="return validate_form()">
<table border="0">
	<tr>
		<td>Pilih PBF</td>
		<td>:</td>
		<td>
		<select name="kode_pbf">
		<?php
		$sql = "select * from pbf";		//ambil data dari tabel PBF
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			if($row['kode_pbf']==$kode_pbf){
				$select = "selected = 'selected'";
			}else{
				$select = "";
			}
			echo "<option value='$row[kode_pbf]' $select>$row[nama_pbf]</option>";
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td>Jumlah Obat yang Dipesan</td>
		<td>:</td>
		<td><input type="text" name="jumlah" value="<?php echo $jumlah; ?>" autofocus/></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="input" value="Input" /></td>
	</tr>
</table>

<?php
if(isset($_POST['input'])){?>
	<br />
	<table border="1">
	<tr  bgcolor="#00FFFF">
		<td align="center">No</td>
		<td align="center" width="300">Nama Obat</td>
		<td align="center">Jumlah</td>
	</tr>
		<?php
		for($i=1;$i<=$jumlah;$i++){
			$nama_obat[$i]=@$_POST['nama_obat'.$i];
			$jumlah_obat[$i]=@$_POST['jumlah_obat'.$i];		
		}
		
		for($i=1;$i<=$jumlah;$i++){?>
			<tr>
				<td align="center"><?php echo $i;?></td>
				<td>
				<input size="50" type='text' onKeyUp="autoComplete();" id="inputan" name="nama_obat<?php echo $i;?>" autofocus autocomplete="off"/>
			<div id='hasil'></div> <!– menampilkan hasil search –>
				</td>
				<td><input type="text" name="jumlah_obat<?php echo $i;?>" size="10" value="<?php echo $jumlah_obat[$i]; ?>" autocomplete="off"/></td>
			</tr>
		<?
		}
		?>
	</table>
	
	<br /><font size="1">* ID Pesan dan Tanggal Pesan akan di-generate secara otomatis, silahkan klik button dibawah ini untuk mencetak Surat Pemesanan</font><br />
	<br /><input type="submit" value="PESAN" name="insert_pemesanan" />
	</form> <!--TUTUP FORM di LINE 43--> 
<?php
} //tutup if(isset($_POST['input']))

if(isset($_POST['insert_pemesanan'])){

		$jumlah = @$_POST['jumlah'];
		$kode_pbf = @$_POST['kode_pbf'];
		$username = @$_SESSION['username'];
		$tgl_pesan = date('Y-m-d');
		$insert = "insert into pemesanan(id_pesan,tgl_pesan,kode_pbf,username) values('','$tgl_pesan','$kode_pbf','$username')"; //insert tbl PEMESANAN
		
		$query = mysql_query($insert);
		$ambil="select id_pesan from pemesanan order by id_pesan DESC";
		$eks_ambil=mysql_query($ambil);
		$hasil_ambil=mysql_fetch_row($eks_ambil);
		
		$id_pesan =$hasil_ambil[0];
		//$query = mysql_query($insert);
		//echo $id_pesan = mysql_insert_id();
		
			for($i=1;$i<=$jumlah;$i++){
				$nama_obat=@$_POST['nama_obat'.$i];
				$jumlah_obat=@$_POST['jumlah_obat'.$i];
				$insert_detail = "insert into detail_pemesanan(id_pesan,kode_obat,jumlah) values('$id_pesan','$nama_obat','$jumlah_obat')";
				$query_detail=mysql_query($insert_detail);
			}
			
			if($query){
				?>
				<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
				<script src="jquery.printPage.js" type="text/javascript"></script>
				
				<script>  
				$(document).ready(function() {
				$(".btnPrint").printPage();
				});
				</script>

				<?php
					$nama_pbf = "select pbf.nama_pbf from pbf,pemesanan pes, detail_pemesanan dp where pbf.kode_pbf = pes.kode_pbf AND pes.id_pesan = dp.id_pesan AND pes.id_pesan='$id_pesan'";
					$eks2 = mysql_query($nama_pbf);
					while($row=mysql_fetch_array($eks2)){
						$nm_pbf = $row[0];
					}
				?>
				<hr />
				<center>
				<table border="0">
					<tr>
						<td rowspan="6" width="60"><img src="farmasi.jpg" /></td>
					</tr>
					<tr align="center">
						<td><font size="+1"><b>APOTEK TRIDAYA BUANA SEJAHTERA (TBS)</b></font></td>
					</tr>
					<tr align="center">
						<td>Apoteker : R. Pertiwi D,S.Farm.,Apt</td>
					</tr>
					<tr align="center">
						<td>No. Sp : KP. 01.03.1.3.2830</td>
					</tr>
					<tr align="center">
						<td>Griya Bandung Asri 2 Blok M2 No. 19 Bandung</td>
					</tr>
					<tr align="center">
						<td>Telp (022) - 7532003 - 7531945</td>
					</tr>
				</table>
				<hr />
				<font size="+1"><b>SURAT PESANAN</b></font>
				</center>
				
				<font size="-1">
				Kepada YTH : <b><?php echo $nm_pbf; ?></b> <br /><br />
				
				No Pesan : <?php echo $id_pesan; ?> <br />
				Tanggal Pesan (YYYY-MM-DD) : <?php echo $tgl_pesan; ?> <br />
				Dipesan oleh : <?php echo $username; ?>
				<hr />
				
				<table border="1">
					<tr align="center" bgcolor="#00FFFF">
						<td width="250">Nama Obat</td>
						<td width="100">Satuan</td>
						<td width="100">Jumlah</td>
					</tr>
					<?php
						$totitem = "select sum(jumlah) as jum from detail_pemesanan dp where id_pesan='$id_pesan' group by id_pesan";
						$ekstotitem = mysql_query($totitem);
						$hasil = mysql_fetch_array($ekstotitem);
						$total_item = $hasil[0];
						
						$detail_pesan = "select o.nama_obat,o.satuan,dp.jumlah from obat o,detail_pemesanan dp where o.kode_obat=dp.kode_obat AND dp.id_pesan='$id_pesan'";
						$eks3 = mysql_query($detail_pesan);
						$item = mysql_num_rows($eks3);
						while($row=mysql_fetch_array($eks3)){
							?>
							<tr>
								<td><?php echo $row['nama_obat']; ?></td>
								<td align="center"><?php echo $row['satuan']; ?></td>
								<td align="center"><?php echo $row['jumlah']; ?></td>
							</tr>
							<?php
							
						} // tutup WHILE
						?>
				</table><br />
				<?php echo("Total Jenis Item = $item"); ?>
				<?php echo("<br/>Total Jumlah Obat = $total_item"); ?>
				
				<br /><br /><br />
				
				Apotek TBS<br /><br /><br /><br />---------------------
				
				<p><a class="btnPrint" href='iframes/print_pemesanan.php'>Print!</a></p>
				<script language="javascript">
					alert('Pemesanan Telah dilakukan');
				</script>
				<?php
			} //tutup if($query)

} //tutup if(isset($_POST['insert_pemesanan'])){
?>