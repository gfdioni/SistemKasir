<h5>Halaman Faktur</h5>
<b><a href="?page=faktur_histori">Histori Faktur</a></b><br /><hr />

<script language="javascript" type="text/javascript">
function validate_form2 ()
{
	valid = true;
	var angka = /^[0-9]+$/;
	
	if ( document.faktur.no_faktur.value == "" )
	{
        alert ( "Nomor Faktur belum diisi" );
        valid = false;
    }
	if ( document.faktur.diskon_ekstra.value == "" )
	{
        alert ( "Diskon Ekstra belum diisi" );
        valid = false;
    }
	if ( document.faktur.tgl_jatuh_tempo.value == "" )
    {
        alert ( "Tanggal Jatuh Tempo belum diisi" );
        valid = false;
    }
//	if ( document.faktur.ppn.notchecked)
//    {
//        alert ( "PPN belum dipilih" );
//        valid = false;
//    }
	
	return valid;
}
</script>

<?php
include("koneksi.php");
$id_pesan=@$_GET['id_pesan'];
$id_pesan2 = @$_GET['id_pesan2'];
?>

<font color="#FF0000"><b>Berikut ini adalah Daftar Pemesanan Pending<br />
Silahkan Klik ID Pesan Untuk Menampilkan detail data..</b></font>
<br /><br />

<table border="1" bgcolor="yellow">
	<tr align="center">
		<td width="50">ID Pesan</td>
		<td width="150">Tanggal Pesan</td>
		<td width="350">Nama PBF</td>
		<td width="100">Pemesan</td>
		<td width="70">Aksi</td>
	</tr>
	<?php
	$query = "select distinct(pemesanan.id_pesan), pemesanan.tgl_pesan, pbf.nama_pbf, pemesanan.username from pbf,pemesanan,faktur where pbf.kode_pbf = pemesanan.kode_pbf AND pemesanan.id_pesan not in (select faktur.id_pesan from faktur) order by pemesanan.id_pesan ASC";
	$eks = mysql_query($query);
	while($row=mysql_fetch_array($eks)){?>
		<tr align="center" bgcolor="#00FFFF">
			<td><?php echo ("<a href=\"?page=faktur_insert&id_pesan=$row[0]\">$row[0]</a>"); ?></td>
			<td><?php echo date('d-m-Y', strtotime($row[1]));?></td>
			<td><?php echo $row[2];?></td>
			<td><?php echo $row[3];?></td>
			<td><?php echo (" <a href=\"?page=faktur_insert&id_pesan2=$row[0]\">Batalkan</a>");?></td>
		</tr>
	<?php	
	} // TUTUP WHILE ?>
</table>
<br /><hr />

<!-- ---------------------------------------- MENGHAPUS PEMESANAN --------------------------------------------- -->
<?php 
	if($id_pesan2!=""){
		$query1 = "DELETE FROM DETAIL_PEMESANAN WHERE id_pesan = '$id_pesan2'";
		$query2 = "DELETE FROM PEMESANAN WHERE id_pesan = '$id_pesan2'";
		mysql_query($query1);
		mysql_query($query2);?>
		<script language="javascript">
			alert('Pemesanan Berhasil Dibatalkan');
			<?php echo("document.location='index.php?page=faktur_insert'"); ?>
		</script> <?
	}// tutup if($id_pesan2!="")
?>
<!-- ---------------------------------------- END OF MENGHAPUS PEMESANAN --------------------------------------------- -->


<!-- -------------------------------------------BILA ID PESAN DI KLIK --------------------------------------------------- -->
<?php
	if($id_pesan != ""){?>
		<br /><font color="#3333FF" size="4"><center>FORM FAKTUR OBAT (OBAT MASUK KE GUDANG)</center></font>
		<form name="faktur" action="?page=faktur_insert" method="post" onsubmit="return validate_form2();">
		<input type="hidden" name="id_pesan" value="<?php echo $id_pesan; ?>">
		<table>
			<tr>
				<td width="70">ID pesan</td> 
				<td>: <?php echo $id_pesan; ?></td>
			</tr>
			<tr><?php
				$queryn = "select nama_pbf from pbf p, pemesanan pes where p.kode_pbf=pes.kode_pbf AND pes.id_pesan = $id_pesan";
				$eksn = mysql_query($queryn);
				$ambiln = mysql_fetch_array($eksn)?>
				<td>Nama PBF</td> 
				<td>: <b> <?php echo $ambiln[0];?></b></td>
			</tr>
			<tr>
				<td>No Faktur</td> 
				<td>: <input type="text" name="no_faktur" autocomplete="off" /></td>
			</tr>
			<tr>
				<td>Tgl JT</td>
				<td>: <input type="text" name="tgl_jatuh_tempo" /><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.faktur.tgl_jatuh_tempo);return false;" ><img name="popcal" align="absmiddle" style="border:none" src="./calender/calender.jpeg" width="34" height="29" border="0" alt=""></a>
				</td>
			</tr>
		</table>
		<br />
		<font color="#FF0000"><b>
		PERHATIAN PENTING : <br /></b>
		1. PASTIKAN SEMUA FIELD DIISI!<br />
		2. DISKON TIDAK BOLEH DITULIS DENGAN KOMA (,) GUNAKAN TITIK (.)<br />
		3. PASTIKAN PILIHAN PPN DIISI!
		</font>
		<br /><br />
			
		<table border="1" align="center">
			<tr bgcolor="#00CCFF">
				<th>No</th>
				<th width="300">Nama Obat</th>
				<th  align="center" width="70">Satuan</th>
				<th align="center" width="50">Jumlah Pesan</th>
				<th width="50">Jml Yg Dikirim</th>
				<!--<th width="80">No Batch</th>-->
				<th width="150">Expired</th>
				<th width="100">HNA Lama</th>
				<th width="100">Harga Satuan</th>
				<th width="70">Diskon 1(%)</th>
				<th width="70">Diskon 2(%)</th>
				<th width="70">Diskon 3(%)</th>
				<th width="70">Diskon 4(%)</th>
			</tr>
		<?php
		$sql="select pemesanan.id_pesan,detail_pemesanan.kode_obat,detail_pemesanan.jumlah,obat.nama_obat,obat.satuan from pemesanan,detail_pemesanan,obat where pemesanan.id_pesan=detail_pemesanan.id_pesan and detail_pemesanan.kode_obat = obat.kode_obat and pemesanan.id_pesan='$id_pesan'";
		$query=mysql_query($sql);
		$no=1;
		while($row=mysql_fetch_array($query)){?>
		<tr align='center'>
			<td align='center'><?php echo $no; ?></td>
			<td><?php echo $row['nama_obat']; ?></td>
			<td><?php echo $row['satuan']; ?></td>
			<td align='center'><?php echo $row['jumlah']; ?></td>
			<td><input type="text" maxlength="5" size="1" name="jumlah<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['jumlah'] ?>" size="1" /></td>
			<!--<td><input type="text" autocomplete="off" maxlength="10" size="11" name="batch<?php //echo $row['id_pesan'] ?>kode<?php //echo $row['kode_obat'] ?>"  size="5" placeholder="harus diisi!" /></td>-->
			<td><input type="text" size="8" name="expired<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>"  size="5" />
				<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.faktur.expired<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>);return false;" ><img name="popcal" align="absmiddle" style="border:none" src="./calender/calender.jpeg" width="34" height="29" border="0" alt=""></a>
			</td>
			<?php 
			//ambil HNA lama
			$hna="select harga from detail_faktur where kode_obat='$row[kode_obat]' order by tgl_obat_masuk,jam_obat_masuk DESC";
			$ekshna=mysql_query($hna);
			$ambilhna=mysql_fetch_row($ekshna);
			$hasilhna=$ambilhna[0];
			?>
			<td><?php echo number_format($hasilhna,0,",","."); ?></td>
			<td><input type="text" autocomplete="off" name="harga<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>" maxlength="10" size="10" /></td>
			<td width="50"><input type="text" autocomplete="off" name="diskon1<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>" maxlength="10" size="5" value="0" />	</td>
			<td width="50"><input type="text" autocomplete="off" name="diskon2<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>" maxlength="10" size="5" value="0" />	</td>
			<td width="50"><input type="text" autocomplete="off" name="diskon3<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>" maxlength="10" size="5" value="0" />	</td>
			<td width="50"><input type="text" autocomplete="off" name="diskon4<?php echo $row['id_pesan'] ?>kode<?php echo $row['kode_obat'] ?>" maxlength="10" size="5" value="0" />	</td>
		<?php		
		echo "</tr>";	
			$no++;
		} //tutup WHILE 
			?>
		</table>	<!--TUTUP TABLE di LINE-->
		<br />
		<input type="radio" name="ppn" value="1" />Harga Sudah Termasuk PPN 10%<br />
		<input type="radio" name="ppn" value="2" />Harga Belum Termasuk PPN 10%<br />
		Diskon Ekstra (%) : <input type="text" name="diskon_ekstra" autocomplete="off" />	
		<br /><font size="2"><br /><br />* Tanggal faktur dan total harga akan di-generate secara otomatis</font><br /><br />
		<input type="submit" value="CONFIRM" name="confirm" />		
	</form> <!--tutup <form name="faktur" action="?page=faktur_insert" method="post" onsubmit="return validate_form2();">-->
	
	<?php
	} // tutup IF di LINE if($id_pesan != ""){
	
	if(isset($_POST['confirm'])){
		$id_pesan = $_POST['id_pesan'];
		$no_faktur = $_POST['no_faktur'];
		$tgl_jatuh_tempo = $_POST['tgl_jatuh_tempo'];
		$diskon_ekstra = $_POST['diskon_ekstra'];
		$username = $_SESSION['username'];
		$pajak = $_POST['ppn'];
		
		if($pajak==1){
			$besarppn=0;
		}else{
			$besarppn=10;
		}
		
		$insert = "insert into faktur (id_pesan,no_faktur,tgl_faktur,tgl_jatuh_tempo,username,diskon_ekstra,ppn) values ('$id_pesan','$no_faktur',curdate(),'$tgl_jatuh_tempo','$username','$diskon_ekstra','$besarppn')";
		$query = mysql_query($insert);
	
		$sql = "select pemesanan.id_pesan,detail_pemesanan.kode_obat,detail_pemesanan.jumlah,obat.nama_obat from pemesanan,detail_pemesanan,obat where pemesanan.id_pesan=detail_pemesanan.id_pesan and detail_pemesanan.kode_obat = obat.kode_obat and pemesanan.id_pesan='$id_pesan'";
		$query=mysql_query($sql);
		$total = 0;
		while($row=mysql_fetch_array($query)){
			$kode_obat = $row['kode_obat'];
			//$no_batch = $_POST['batch'.$id_pesan.'kode'.$kode_obat] ;
			$expired 	= $_POST['expired'.$id_pesan.'kode'.$kode_obat] ;
			$jumlah 	= $_POST['jumlah'.$id_pesan.'kode'.$kode_obat] ;
			$harga 		= $_POST['harga'.$id_pesan.'kode'.$kode_obat] ;
			$diskon1 	= $_POST['diskon1'.$id_pesan.'kode'.$kode_obat] ;
			$diskon2 	= $_POST['diskon2'.$id_pesan.'kode'.$kode_obat] ;
			$diskon3 	= $_POST['diskon3'.$id_pesan.'kode'.$kode_obat] ;
			$diskon4 	= $_POST['diskon4'.$id_pesan.'kode'.$kode_obat] ;
			
			if($jumlah>0){
				$subtotal1 = $harga*$jumlah;
				$subtotal2 = $subtotal1 - ($subtotal1*($diskon1/100));
				$subtotal3 = $subtotal2 - ($subtotal2*($diskon2/100));
				$subtotal4 = $subtotal3 - ($subtotal3*($diskon3/100));
				$subtotal5 = $subtotal4 - ($subtotal4*($diskon4/100));
				
				$insert2="insert into detail_faktur(no_faktur,kode_obat,no_batch,expired,jumlah,harga,diskon1,diskon2,diskon3,diskon4,tgl_obat_masuk,jam_obat_masuk)		values('$no_faktur','$kode_obat','','$expired','$jumlah','$harga','$diskon1','$diskon2','$diskon3','$diskon4',curdate(),curtime())";
				$query2=mysql_query($insert2);
			} // tutup if($jumlah>0){
			$total = $total + $subtotal5;
			
			//update harga di tabel obat (harga obat otomatis diupdate (+10% dari harga pembelian)
			//$hargabaru		= $harga+($harga*(10/100));
			//$hargabulat		= ceil($hargabaru); //pembulatan harga keatas (ceiling)
			//$updateharga 		= "update obat set harga='$hargabulat' where kode_obat='$kode_obat'";
			//$eksupdateharga 	= mysql_query($updateharga);
			
		} // tutup WHLIE di LINE while($row=mysql_fetch_array($query)){
		//PERHITUNGAN PPN
			$ppn = $_POST['ppn'];
			if($ppn == 1){ //harga sudah termasuk PPN
				$total = $total-($total*($diskon_ekstra/100));
			}else{ // harga belum termasuk PPN
				$total = ($total + ($total*(10/100)))-($total + ($total*(10/100)))*($diskon_ekstra/100);
			}
		$update = "update faktur set total_harga = '$total' where no_faktur = '$no_faktur'";
		mysql_query($update);
		
		if($query){
			?>
			<script language="javascript">
				alert('Data Faktur Berhasil Disimpan');
				<?php echo("document.location='index.php?page=pembelian_insert&no_faktur=$no_faktur&ppn=$ppn'"); ?>
			</script>
			<?php
		} // tutup if di LINE if($query){
	} // tutup IF di LINE if(isset($_POST['confirm'])){
	?>
	
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>