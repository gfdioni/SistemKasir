<script language="javascript" type="text/javascript">
	function validate_form(){
		valid = true;
		var angka = /^[0-9]+$/;
		if ( document.mutasi.qty.value == "" ){
			alert ( "Jumlah Mutasi belum diisi." );
			valid = false;
		}
		if ( document.mutasi.qty.value == "0" ){
			alert ( "Jumlah Mutasi tidak boleh 0." );
			valid = false;
		}
		if ( !document.mutasi.qty.value.match(angka) ){
			alert ( "Jumlah mutasi harus angka." );
			valid = false;
		}
		return valid;
	}
</script>

Input Jumlah Yang Akan Dimutasi : <br /><br /><hr /><br />

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);

$nama_obat 		= @$_GET['nama_obat'];
$kode_obat		= @$_GET['kode_obat'];
$satuan		 	= @$_GET['satuan'];
$stok_gudang	= @$_GET['stok'];

?>
<form name="mutasi" method="post" onsubmit="return validate_form()" action="?page=mutasi_form">
	<table>
		<tr>
			<td width="100">Kode obat</td>
			<td>:</td>
			<td><?php echo $kode_obat;?>
			<input type="hidden" name="kode_obat" value="<?php echo $kode_obat;?>" />
			</td>
		</tr>
		<tr>
			<td>Nama obat</td>
			<td>:</td>
			<td><?php echo $nama_obat;?></td>
		</tr>
		<tr>
			<td>Satuan</td>
			<td>:</td>
			<td><?php echo $satuan; $satuan	= @$_POST['satuan'];?></td>
		</tr>
		<tr>
			<td>Stok Gudang</td>
			<td>:</td>
			<td><?php echo $stok_gudang;?>
			<input type="hidden" name="stok_gudang" value="<?php echo $stok_gudang;?>" />
			</td>
		</tr>
		<tr>
			<td>Jumlah Mutasi</td>
			<td>:</td>
			<td><input type="text" name="qty" size="1" maxlength="3" autocomplete="off" autofocus/></td>
		</tr>
		<tr>
			<td colspan="3"><input name="mutasi" type="submit" value="MUTASIKAN" /></td>
		</tr>
	</table>
</form>

<?php
if(isset($_POST['mutasi'])){

	$kode_obat	= @$_POST['kode_obat'];
	$qty		= @$_POST['qty'];
	$stok_gudang= @$_POST['stok_gudang'];
	
	if ($qty>$stok_gudang){?> <!--jika stok tidak cukup untuk dimutasikan-->
		<script language="javascript">
			alert('Stok tidak mencukupi, sisa stok <?php echo $stok_gudang; ?>. SILAHKAN LAKUKAN PEMESANAN');
			document.location='index.php?page=mutasi';
		</script>
	<?php
	}else{
		$qty		= @$_POST['qty'];
		$temp_qty	= $qty;
		
		$sql="select * from obat o, batch b where o.kode_obat=b.kode_obat and o.kode_obat='$kode_obat' and stok>0 order by b.expired asc, b.tgl_obat_masuk asc, b.jam_obat_masuk asc";
		$query=mysql_query($sql);
		while($temp_qty>0){
			$row=mysql_fetch_array($query);
			
			$kode_obat	=$row['kode_obat'];
			$batch		=$row['no_batch'];
			$expired	=$row['expired'];
			$stok		=$row['stok'];
			$tgl_masuk	=$row['tgl_obat_masuk'];
			$jam_masuk	=$row['jam_obat_masuk'];
			$temp_stok	=$stok;
						
			if($temp_stok>$temp_qty){
				$insert1 = "insert into etalase(kode_obat, no_batch, expired, stok, tgl_obat_masuk, jam_obat_masuk,tgl_mutasi) 	values('$kode_obat','$batch','$expired','$temp_qty','$tgl_masuk','$jam_masuk',now())";
				mysql_query($insert1);
				$sisa = $stok - $temp_qty; //digunakan untuk mengurangi stok di tabel batch
				$update1 = "update batch set stok='$sisa' where no_batch='$batch'";
				mysql_query($update1);
				$temp_qty=$temp_qty-$temp_qty;
			}
			else{ 
				//$temp_stok = $stok;
				$insert2 = "insert into etalase(kode_obat, no_batch, expired, stok, tgl_obat_masuk, jam_obat_masuk,tgl_mutasi) 	values('$kode_obat','$batch','$expired','$temp_stok','$tgl_masuk','$jam_masuk',now())";
				mysql_query($insert2);
				$sisa2 = $stok - $temp_stok; //digunakan untuk mengurangi stok di tabel batch
				$update2 = "update batch set stok='$sisa2' where no_batch='$batch'";
				mysql_query($update2);
				$temp_qty = $temp_qty-$temp_stok;
			}
		} //tutup while($row=mysql_fetch_array($query)){?>
		<script language="javascript">
			alert('Mutasi Telah dilakukan, Stok Obat di Etalase Bertambah');
		<?php echo ("document.location='index.php?page=mutasi'"); ?>
		</script>
		<?php
		
		//masukkan data ke tabel mutasi
		$ambil_id_mutasi = "select id from mutasi order by id DESC";
		$eks_ambil_id_mutasi = mysql_query($ambil_id_mutasi);
		$hasil_id_mutasi = mysql_fetch_array($eks_ambil_id_mutasi);
		$id_mutasi = $hasil_id_mutasi['id'];
		
		$in_mutasi = "insert into detail_mutasi value ('$id_mutasi','$kode_obat','$qty')";
		mysql_query($in_mutasi);
	} //tutup ELSE
	
} //tutup if(isset($_POST['mutasi'])){
?>