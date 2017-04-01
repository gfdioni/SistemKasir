<h5>Halaman Penjualan Khusus Dokter</h5>

<?php
include("koneksi.php");

$jumlah=@$_POST['jumlah'];
$diskon=@$_POST['diskon'];
$dokter=@$_POST['dokter'];
error_reporting(E_ALL ^ E_NOTICE);
$username=@$_SESSION['username']; //ambil username dari session
?>

<?php
//query untuk menghapus transaksi
$kode_obat = @$_GET['kode_obat'];
if($kode_obat!=""){
	$query = "DELETE FROM TEMP_PENJUALAN WHERE kode_obat = '$kode_obat' AND username = '$username' ";
	mysql_query($query);
}
?>

<script language="JavaScript" type="text/javascript">
function confirmDelete() {
	conf = true;
	
	if (confirm("Hapus Data?")) {
		<?php
		$sql = "select * from temp_penjualan where kode_obat = '$kode_obat'";
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
ajaxRequest.open("GET","penjualan/penjualan_ambil_kode.php?input="+input);
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
	
	if ( document.jumlah.kode_obat.value == "" )
    {
        alert ( "Nama Obat belum diisi." );
        valid = false;
    }	
	if ( document.jumlah.qty.value == "" )
    {
        alert ( "Jumlah beli belum diisi." );
        valid = false;
    }
	if ( document.jumlah.diskon.value == "" )
    {
        alert ( "Diskon beli belum diisi." );
        valid = false;
    }	
/*	if ( !document.jumlah.qty.value.match(angka) )
    {
        alert ( "Jumlah beli harus angka." );
        valid = false;
    }
	if ( !document.jumlah.diskon.value.match(angka) )
    {
        alert ( "Diskon harus angka." );
        valid = false;
    }*/
    return valid;
}

function validate_form2()
{
    valid = true;
	var angka = /^[0-9]+$/;
	
	if ( document.bayar.bayar.value == "" )
    {
        alert ( "Pembayaran belum diisi." );
        valid = false;
    }
	if ( document.bayar.dokter.value == "" )
    {
        alert ( "Nama Dokter belum diisi." );
        valid = false;
    }
	//if ( !document.bayar.bayar.value.match (angka) )
//    {
//        alert ( "Pembayaran harus angka." );
//        valid = false;
//    }
	
    return valid;
}
</script>

<br /><marquee width="400"><font color="#3333FF" size="3">PENJUALAN KHUSUS DOKTER</font></marquee><br /><br />
<form name="jumlah" action="?page=penjualan_insert_dokter" method="post" onsubmit="return validate_form();">
<table border="0">
	<tr>
		<td>Jumlah</td>
		<td>:</td>
		<td><input type="text" name="qty" value="<?php echo $_POST['qty'];?>" autocomplete="off" placeholder="harus diisi..!"></td>
	</tr>
	<tr>
		<td>Diskon</td>
		<td>:</td>
		<td><input type="text" name="diskon" value="<?php echo $_POST['diskon'];?>" autocomplete="off" placeholder="harus diisi..!"></td>
	</tr>
	<tr>
		<td>Nama obat</td>
		<td>:</td>
		<td><input type='text' onKeyUp="autoComplete();" id='inputan' name="kode_obat" autofocus />
			<div id='hasil'></div> <!– menampilkan hasil search –>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="tambah" value="tambah"/></td>
	</tr>
</table>
</form>

<form name="bayar" action="?page=penjualan_insert_dokter" method="post" onsubmit="return validate_form2();">
<?php
if(isset($_POST['tambah'])){ //script ini dilkukan saat button bernama "tambah" ditekan ?>

	<table>
		<tr>
			<td width="60">Dokter</td>
			<td>:</td>
			<td><input type="text" name="dokter" autocomplete="off" placeholder="harus diisi..!" value="umum" /></td>
		</tr>
		<tr>
			<td>Cash</td>
			<td>:</td>
			<td><input type="text" name="bayar" autocomplete="off" placeholder="harus diisi..!" /></td>
		</tr>
		<tr>
			<td>No Kartu</td>
			<td>:</td>
			<td><input type="text" name="no_kartu" autocomplete="off" value="0"/></td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" value="confirm" name="insert_penjualan" /></td>
		</tr>
	</table>
	
	<?php	
	$kode_obat = @$_POST['kode_obat']; //ambil kode_obat dari form diatas yang bernama"jumlah" dan masukkan ke variabel $kode_obat
	$qty = @$_POST['qty']; //ambil qty dari form diatas yang bernama"jumlah" dan masukkan ke variabel $qty
	$diskon = @$_POST['diskon'];
	
	//$cekstok = "select sum(stok) from batch where kode_obat = '$_POST[kode_obat]' AND EXPIRED-CURDATE() >= 100 group by kode_obat"; //query untuk cek jumlah stok obat saat ini
	$cekstok = "select sum(stok) from etalase where kode_obat = '$_POST[kode_obat]' group by kode_obat"; //query untuk cek jumlah stok obat saat ini
	$eks = mysql_query($cekstok); //eksekusi query bernama $cekstok diatas
	$row=mysql_fetch_array($eks);
	$stok_sekarang=$row[0]; //masukkan jumlah stok obat ke variabel $stok_sekarang
	
	if($qty>$stok_sekarang){ //bila stok TIDAK MENCUKUPI untuk dijual, maka lakukan script di bawah ini?>
	
		<script language="javascript">
			alert('Stok di Etalase tidak mencukupi, sisa stok <?php echo $stok_sekarang; ?>. Silahkan lakukan MUTASI PRODUK');
		</script>
		
		<table border="0" align="center">
			<tr  bgcolor="#00FFFF" align="center">
				<td width="200">Nama Obat</td>
				<td width="75">Satuan</td>
				<td width="75">Harga</td>
				<td width="50">QTY</td>
				<td width="70">Diskon %</td>
				<td width="100">Sub Total</td>
			</tr>
			<?php
			$totalharga = 0;
			$sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat AND username='$username'";
			$query=mysql_query($sql);
			while($row=mysql_fetch_array($query)){
			$total = ($row['harga']*$row['qty'])-($row['harga']*$row['qty']*($row['diskon']/100));
			?>
				<tr>
					<td align="left"><?php echo $row['nama_obat']; ?></td>
					<td align="center"><?php echo $row['satuan']; ?></td>
					<td align="right"><?php echo $row['harga']; ?></td>
					<td align="center"><?php echo $row['qty']; ?></td>
					<td align="center"><?php echo $row['diskon']; ?></td>
					<td align="right"><?php echo $total; ?></td>
				</tr>
			<?php
			$totalharga = $totalharga + $total;
			}
			?>
		</table><br />
		<?php echo"<font size='5'>Rp. ".number_format($totalharga,0,",",".").",00</font>"; ?> <br />
	<?php
	}else{ // bila stok etalase cukup dijual?>
		<table border="0" align="center">
			<tr  bgcolor="#00FFFF" align="center">
				<td width="400">Nama Obat</td>
				<td width="75">Satuan</td>
				<td width="75">Harga</td>
				<td width="50">QTY</td>
				<td width="70">Diskon %</td>
				<td width="50">Sub Total</td>
				<td width="100">Opr</td>
			</tr>
			<?php
			$totalharga = 0;

			$insert="insert into temp_penjualan(kode_obat,qty,diskon,username) values ('$kode_obat','$qty','$diskon','$username')"; 
			mysql_query($insert);
		
			$sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat AND username='$username'";
			$query=mysql_query($sql);
			while($row=mysql_fetch_array($query)){
			$total = ($row['harga']*$row['qty'])-($row['harga']*$row['qty']*($row['diskon']/100)); ?>
				<tr>
					<td align="left"><?php echo $row['nama_obat']; ?></td>
					<td align="center"><?php echo $row['satuan']; ?></td>
					<td align="center"><?php echo $row['harga']; ?></td>
					<td align="center"><?php echo $row['qty']; ?></td>
					<td align="center"><?php echo $row['diskon']; ?></td>
					<td align="center"><?php echo $total;?></td>
					<td align="center"><a href="index.php?page=penjualan_insert&kode_obat=<?php echo $row['kode_obat']; ?>"  onClick='return confirmDelete();'>hapus</a></td>
				</tr>
			<?php
			$totalharga = $totalharga + $total;
			}
			?>
		</table><br />
		<?php echo"<font size='5'>Rp. ".number_format($totalharga,0,",",".").",00</font>"; ?> <br /><?php
	}
} // tutup IF line if(isset($_POST['tambah'])){ ?>			
</form>

<?php
if(isset($_POST['insert_penjualan'])){ //script ini dilakukan saat button bernama"confirm" ditekan
	
	$totalharga=0;
	$sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat AND username='$username'";
	$querysql=mysql_query($sql);
	while($row=mysql_fetch_array($querysql)){
		//$total = $row['harga']*$row['qty'];
		$total = ($row['harga']*$row['qty'])-($row['harga']*$row['qty']*($row['diskon']/100));
		$totalharga = $totalharga + $total;
	}
	
	$no_kartu 	= $_POST['no_kartu'];
	$dokter		= $_POST['dokter'];
	$bayar 		= $_POST['bayar'];
	if($bayar < $totalharga){ // JIKA UANG PEMBAYARAN TIDAK MENCUKUPI
	
		?><script language="javascript">alert("Pembayaran Tidak Mencukupi -- <?php echo "Total Harga = $totalharga -- Pembayaran=$bayar";?>");</script>
		<form action="?page=penjualan_insert_dokter" method="post">
			<table>
				<tr>
					<td>Nama Dokter</td>
					<td>:</td>
					<td><input type="text" name="dokter" autocomplete="off" placeholder="harus diisi..!" value="umum"/></td>
				</tr>
				<tr>
					<td>Cash</td>
					<td>:</td>
					<td><input type="text" name="bayar" autocomplete="off" placeholder="harus diisi..!" /></td>
				</tr>
				<tr>
					<td>No Kartu</td>
					<td>:</td>
					<td><input type="text" name="no_kartu" autocomplete="off" value="0"/></td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" value="confirm" name="insert_penjualan" /></td>
				</tr>
			</table>	
		</form>

		<table border="0" align="center">
			<tr  bgcolor="#00FFFF" align="center">
				<td width="400">Nama Obat</td>
				<td width="75">Satuan</td>
				<td width="75">Harga</td>
				<td width="50">QTY</td>
				<td width="70">Diskon %</td>
				<td width="50">Sub Total</td>
			</tr>
			<?php
			$totalharga = 0;

			//$insert="insert into temp_penjualan(kode_obat,qty) values('$kode_obat','$qty')"; //ambil variabel $kode_obat dan $qty dari LINE 50-51
			//mysql_query($insert);
		
			$sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat AND username='$username'";
			$query=mysql_query($sql);
			while($row=mysql_fetch_array($query)){
			//$total = $row['harga']*$row['qty']; 
			$total = ($row['harga']*$row['qty'])-($row['harga']*$row['qty']*($row['diskon']/100));?>
				<tr>
					<td align="left"><?php echo $row['nama_obat']; ?></td>
					<td align="center"><?php echo $row['satuan']; ?></td>
					<td align="right"><?php echo $row['harga']; ?></td>
					<td align="center"><?php echo $row['qty']; ?></td>
					<td align="center"><?php echo $row['diskon']; ?></td>
					<td align="right"><?php echo $total;?></td>
				</tr>
			<?php
			$totalharga = $totalharga + $total;
			}
			?>
		</table><br />
		<?php echo"<font size='5'>Rp. ".number_format($totalharga,0,",",".").",00</font>"; ?> <br />
	<?php	
	}
	else{ // JIKA UANG PEMBAYARAN CUKUP
	
		$tgl_jual=date('Y-m-d'); //ambil tanggal dari fungsi di PHP
		
		//masukkan data ke tabel penjualan
		
		$insert="insert into penjualan(no_struk,tgl_jual,username,jam_jual,no_kartu) values('','$tgl_jual','$username',curtime(),$no_kartu)";
		$query = mysql_query($insert);
		$no_struk = mysql_insert_id(); //mengambil kembali no_struk yang tadi di generate dan telah di save dalam tabel penjualan
		
		//mengambil semua kolom dr tabel obat dan temp_penjualan
		$sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat AND username='$username'";
		$query=mysql_query($sql); //eksekusi query bernama $sql diatas
		
		$total_harga=0; //deklarasikan variabel untuk mengalikan harga obat dan jumlah obat yang dibeli
		while($row=mysql_fetch_array($query)){
			$kode_obat=$row['kode_obat']; //mengambil kode obat dari hasil join table obat dan temp_penjualan
			$qty=$row['qty']; //mengambil qty dari tabel temp_penjualan
			$diskon=$row['diskon']; //mengambil diskon dari tabel temp_penjualan
			
			$sqlcari = "select * from etalase where kode_obat = '$kode_obat' and stok>0 order by tgl_obat_masuk asc, jam_obat_masuk asc, id asc "; //digunakan utk keperluan update stok di batch nanti
			$querycari = mysql_query($sqlcari);
			$rowcari = mysql_fetch_array($querycari);
			
			$id = $rowcari['id'];
			$stok = $rowcari['stok']; // menempatkan jumlah stok dari tabel batch ke dalam variabel $stok
			$temp_qty = $qty; // mengisi variabel $temp_qty dengan variabel $qty yang sudah didapat dari tabel temp_penjualan (LINE 152)
			
			if($stok>=$temp_qty){ // dipilih saat jumlah stok di satu batch mencukupi saat melakukan sekali penjualan
				$total = ($row['harga']*$row['qty'])-($row['harga']*$row['qty']*($row['diskon']/100));
				$insert2 = "insert into detail_penjualan(no_struk,no_batch,harga,jumlah,total_harga,id_etalase,diskon) values('$no_struk','$rowcari[no_batch]','$row[harga]','$qty','$total','$rowcari[id]','$diskon')";
				mysql_query($insert2);
				$total_harga = $total_harga + $total; //digunakan untuk menghitung total harga untuk dimasikkan ke tabel PENJUALAN
				$sisa = $rowcari['stok'] - $qty; //digunakan untuk mengurangi stok di tabel batch
				$update2 = "update etalase set stok='$sisa' where no_batch='$rowcari[no_batch]' and id='$rowcari[id]'";
				mysql_query($update2);
			}
			else{ // dipilih saat jumlah stok di satu batch TIDAK mencukupi saat melakukan penjualan
				while($temp_qty>0){
					if($rowcari['stok']<=$temp_qty){ //dipilih saat stok di satu batch lebih kecil daripada jumlah yang akan dijual
						$jumlah = $rowcari['stok']; //definisikan variabel jumlah, dan isi variabel tersebut sesuai dengan stok di batch
					}else{ //dipilih saat stok di satu batch lebih besar daripada jumlah yang akan dijual
						$jumlah = $temp_qty; //definisikan variabel jumlah, dan isi variabel tersebut sesuai dengan sisa jumlah pengambilan batch
					}
					//$total = $row['harga']*$jumlah;
					$total = ($row['harga']*$jumlah)-($row['harga']*$jumlah*($row['diskon']/100));
					$insert2="insert into detail_penjualan(no_struk,no_batch,harga,jumlah,total_harga,id_etalase,diskon) values('$no_struk','$rowcari[no_batch]','$row[harga]','$jumlah','$total','$rowcari[id]','$diskon')";
					mysql_query($insert2);
					$sisa=$rowcari['stok'] - $jumlah; //digunakan untuk mengurangi stok di tabel batch
					$update2="update etalase set stok='$sisa' where no_batch='$rowcari[no_batch]' and id='$rowcari[id]'";
					mysql_query($update2);
					$temp_qty=$temp_qty-$rowcari['stok']; // digunakan untuk looping hingga $temp_qty bernilai "0"
					$total_harga = $total_harga + $total; //digunakan untuk menghitung total harga untuk dimasikkan ke tabel PENJUALAN
					$rowcari=mysql_fetch_array($querycari);
				} //tutup while di LINE while($temp_qty>0){
			} //tutup else di LINE 
			
		} //tutup WHILE di LINE while($row=mysql_fetch_array($query)){?>

			
			<?php
			if($query){
					$update = "update penjualan set total_harga = '$total_harga', bayar = '$bayar', dokter = '$dokter' where no_struk = '$no_struk'";
					mysql_query($update);
					$hapus = "delete from temp_penjualan where username = '$username'";
					mysql_query($hapus);
					$kembali = $bayar-$total_harga;
					?>
					<script language="javascript">
						alert("Penjualan Sukses -- <?php echo "Total Harga = $totalharga -- Pembayaran=$bayar -- Kembali=$kembali";?>");
						document.location='penjualan/print_struk.php';
					</script>
					<br /><hr />
					
					<font size="-2">
					APOTEK TBS<br />Komp. GBA 2 blok M2 no.19<br />022-7532003<br /><br />
					
					<table border="0">
						<tr>
							<td>No Struk</td>
							<td>:</td> 
							<td><?php echo $no_struk;?></td>
						</tr>
						<tr>
							<td>Kasir</td> 
							<td>:</td>
							<td><?php echo $username; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>:</td>
							<td><?php $tgl=date('d-m-Y'); echo $tgl; ?></td>
						</tr>
					</table>
					<br />
					<table border="0">
						<tr align="center">
							<td width="60">ITEM</td>
							<td width="5">QTY</td>
							<td width="30">PRICE</td>
							<td width="30">SUB</td>
						</tr>
						<?php
						$querystruk="select o.nama_obat, dp.harga as harga, sum(dp.jumlah) as jumlah, sum(dp.total_harga) as total_harga from penjualan p, detail_penjualan dp, batch b, obat o where dp.no_struk=p.no_struk and dp.no_batch = b.no_batch and o.kode_obat=b.kode_obat AND p.no_struk='$no_struk' group by o.kode_obat";
						$eksekusi=mysql_query($querystruk);
						while($row=mysql_fetch_array($eksekusi)){
							$nama_obat=$row['nama_obat'];
							$jumlah=$row['jumlah'];
							$harga=$row['harga'];
							$total_harga=$row['total_harga'];
						?>
							<tr>
								<td><?php echo $nama_obat; ?></td>
								<td align="center"><?php echo $jumlah; ?></td>
								<td align="right"><?php echo"".number_format($harga,0,",",".").",00"; ?></td>
								<td align="right"><?php echo"".number_format($total_harga,0,",",".").",00"; ?></td>
							</tr>
							<?php
							$sqltotal = "select * from penjualan where no_struk='$no_struk'"; //digunakan untuk menampilkan total harga di struk
							$query=mysql_query($sqltotal);
							$row = mysql_fetch_array($query);
							$total_harga = $row['total_harga'];
							?>
							<tr>
							</tr>
						<?php
						} //tutup while di LINE 224
						?>
					</table>
					<br />
					<table>
						<tr>
							<td>T O T A L</td> 
							<td>:</td> 
							<td><?php echo"Rp. ".number_format($total_harga,0,",",".").",00"; ?></td>
						</tr>
						<tr>
							<td>C A S H</td> 
							<td>:</td> 
							<td><?php echo"Rp. ".number_format($bayar,0,",",".").",00"; ?></td>
						</tr>
						<tr>
							<td>C H A N G E</td> 
							<td>:</td> 
							<td><?php echo"Rp. ".number_format($bayar-$total_harga,0,",",".").",00"; ?></td>
						</tr>
					</table>	
					<?php
					echo ("<br/>Terima Kasih<br />Semoga Lekas Sembuh");	?>
				</font><?php
			} // TUTUP IF if($query)
	} // TUTUP ELSE di LINE else{ // JIKA UANG PEMBAYARAN CUKUP 
} //TUTUP IF if(isset($_POST['insert_penjualan'])

?>
<br /><br />
<form name="bayar" action="?page=penjualan_insert_dokter" method="post">
<input type="submit" value="Batalkan Transaksi" name="batal" />
</form> <?php

	if(isset($_POST['batal'])){ //script ini dilakukan saat button bernama"Batalkan Transaksi" ditekan
		$querybatal="delete from temp_penjualan where username = '$username'";
		$eksbatal=mysql_query($querybatal);?>
		<script language="javascript">alert('Transaksi Dibatalkan');
		document.location='index.php?page=penjualan_insert_dokter';
		</script>
	<?php
	} // tutup IF line if(isset($_POST['batal'])?>

