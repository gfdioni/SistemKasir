<h5>Halaman Penjualan</h5>

<?php
include("koneksi.php");

$jumlah=@$_POST['jumlah'];
error_reporting(E_ALL ^ E_NOTICE);
?>

<?php
//query untuk menghapus transaksi
$kode_obat = @$_GET['kode_obat'];
if ($kode_obat!="") {
    $query = "DELETE FROM TEMP_PENJUALAN WHERE kode_obat = '$kode_obat'";
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
            if ($data > 0) {
                ?>
				conf = false;
				alert("Tidak bisa menghapus data! Kode obat ini memiliki index child!");

			<?php

            } elseif ($data < 1) {
                ?>
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
	
	//if ( !document.jumlah.qty.value.match(angka) )
//    {
//        alert ( "Jumlah beli harus angka." );
//        valid = false;
//    }
	
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
	
    return valid;
}
</script>

<br /><marquee width="400"><font color="#3333FF" size="3">KASIR APOTEK TBS</font></marquee><br /><br />
<form name="jumlah" action="?page=penjualan_insert" method="post" onsubmit="return validate_form();">
<table border="0">
	<tr>
		<td>Nama obat</td>
		<td>:</td>
		<td><input type='text' onKeyUp="autoComplete();" id='inputan' name="kode_obat" />
			<div id='hasil'></div> <!– menampilkan hasil search –>
		</td>
	</tr>
	<tr>
		<td>Jumlah</td>
		<td>:</td>
		<td><input type="text" name="qty" value="<?php echo $_POST['qty'];?>"> FORM INI HARUS DIISI</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="tambah" value="tambah" /></td>
	</tr>
</table>
</form>

<form name="bayar" action="?page=penjualan_insert" method="post" onsubmit="return validate_form2();">
<?php
if (isset($_POST['tambah'])) { //script ini dilkukan saat button bernama "tambah" ditekan
    ?><br /><br />Cash : <input type="text" name="bayar" />
	<center><br /><input type="submit" value="confirm" name="insert_penjualan" /></center><?php

    $kode_obat = @$_POST['kode_obat']; //ambil kode_obat dari form diatas yang bernama"jumlah" dan masukkan ke variabel $kode_obat
    $qty = @$_POST['qty']; //ambil qty dari form diatas yang bernama"jumlah" dan masukkan ke variabel $qty
    
    //$cekstok = "select sum(stok) from batch where kode_obat = '$_POST[kode_obat]' AND EXPIRED-CURDATE() >= 100 group by kode_obat"; //query untuk cek jumlah stok obat saat ini
    //$eks = mysql_query($cekstok); //eksekusi query bernama $cekstok diatas
    //while($row=mysql_fetch_array($eks)){
        //$stok_sekarang=$row[0]; //masukkan jumlah stok obat ke variabel $stok_sekarang
    //}
    
    ?>
		<hr />
		<table border="1" align="center">
			<tr  bgcolor="#00FFFF" align="center">
				<td width="400">Nama Obat</td>
				<td width="75">Satuan</td>
				<td width="75">Harga</td>
				<td width="50">QTY</td>
				<td width="50">Sub Total</td>
				<td width="100">Opr</td>
			</tr>
			<?php
            $totalharga = 0;

                $insert="insert into temp_penjualan(kode_obat,qty) values('$kode_obat','$qty')"; //ambil variabel $kode_obat dan $qty dari LINE 50-51
            mysql_query($insert);
        
                $sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat";
                $query=mysql_query($sql);
                while ($row=mysql_fetch_array($query)) {
                    $total = $row['harga']*$row['qty']; ?>
				<tr>
					<td align="left"><?php echo $row['nama_obat']; ?></td>
					<td align="center"><?php echo $row['satuan']; ?></td>
					<td align="center"><?php echo $row['harga']; ?></td>
					<td align="center"><?php echo $row['qty']; ?></td>
					<td align="center"><?php echo $total; ?></td>
					<td align="center"><a href="index.php?page=penjualan_insert&kode_obat=<?php echo $row['kode_obat']; ?>"  onClick='return confirmDelete();'>hapus</a></td>
				</tr>
			<?php
            $totalharga = $totalharga + $total;
                } ?>
		</table><br />
		<?php echo"<font size='5'>Rp. ".number_format($totalharga, 0, ",", ".").",00</font>"; ?> <br />
	<?php

            } // tutup IF line if(isset($_POST['tambah'])){?>			
</form>

<?php
if (isset($_POST['insert_penjualan'])) { //script ini dilakukan saat button bernama"confirm" ditekan
    
    $totalharga=0;
                $sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat";
                $querysql=mysql_query($sql);
                while ($row=mysql_fetch_array($querysql)) {
                    $total = $row['harga']*$row['qty'];
                    $totalharga = $totalharga + $total;
                }
    
                $bayar = $_POST['bayar'];
                if ($bayar < $totalharga) { // JIKA UANG PEMBAYARAN TIDAK MENCUKUPI
    
        ?><script language="javascript">alert("Pembayaran Tidak Mencukupi -- <?php echo "Total Harga = $totalharga -- Pembayaran=$bayar"; ?>");</script>
		<form action="?page=penjualan_insert" method="post">
		Cash = <input type="text" name="bayar" />
		<center><br /><input type="submit" value="confirm" name="insert_penjualan" /></center>				
		</form>
		<hr />
		<table border="0" align="center">
			<tr  bgcolor="#00FFFF" align="center">
				<td width="400">Nama Obat</td>
				<td width="75">Satuan</td>
				<td width="75">Harga</td>
				<td width="50">QTY</td>
				<td width="50">Sub Total</td>
			</tr>
			<?php
            $totalharga = 0;

            //$insert="insert into temp_penjualan(kode_obat,qty) values('$kode_obat','$qty')"; //ambil variabel $kode_obat dan $qty dari LINE 50-51
            //mysql_query($insert);
        
            $sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat";
                    $query=mysql_query($sql);
                    while ($row=mysql_fetch_array($query)) {
                        $total = $row['harga']*$row['qty']; ?>
				<tr>
					<td align="left"><?php echo $row['nama_obat']; ?></td>
					<td align="center"><?php echo $row['satuan']; ?></td>
					<td align="right"><?php echo $row['harga']; ?></td>
					<td align="center"><?php echo $row['qty']; ?></td>
					<td align="right"><?php echo $total; ?></td>
				</tr>
			<?php
            $totalharga = $totalharga + $total;
                    } ?>
		</table><br />
		<?php echo"<font size='5'>Rp. ".number_format($totalharga, 0, ",", ".").",00</font>"; ?> <br />
	<?php	
                } else { // JIKA UANG PEMBAYARAN CUKUP
    
        $tgl_jual=date('Y-m-d'); //ambil tanggal dari fungsi di PHP
        $username=@$_SESSION['username']; //ambil username dari session
        
        //masukkan data ke tabel penjualan
        $insert="insert into penjualan(no_struk,tgl_jual,username) values('','$tgl_jual','$username')";
                    $query = mysql_query($insert);
                    $no_struk = mysql_insert_id(); //mengambil kembali no_struk yang tadi di generate dan telah di save dalam tabel penjualan
        
        //mengambil semua kolom dr tabel obat dan temp_penjualan
        $sql="select * from obat,temp_penjualan where obat.kode_obat=temp_penjualan.kode_obat";
                    $query=mysql_query($sql); //eksekusi query bernama $sql diatas
        
        $total_harga=0; //deklarasikan variabel untuk mengalikan harga obat dan jumlah obat yang dibeli
        while ($row=mysql_fetch_array($query)) {
            $kode_obat=$row['kode_obat']; //mengambil kode obat dari hasil join table obat dan temp_penjualan
            $qty=$row['qty']; //mengambil qty dari tabel temp_penjualan
            
            $sqlcari = "select * from batch where kode_obat = '$kode_obat'"; //digunakan utk keperluan update stok di batch nanti
            $querycari = mysql_query($sqlcari);
            $rowcari = mysql_fetch_array($querycari);
            
            $stok = $rowcari['stok']; // menempatkan jumlah stok dari tabel batch ke dalam variabel $stok
            $temp_qty = $qty; // mengisi variabel $temp_qty dengan variabel $qty yang sudah didapat dari tabel temp_penjualan (LINE 152)
            
            
                $total = $row['harga']*$row['qty']; //variabel $total dgunakan utk mengalikan harga dr tabel obat dengan qty dr tabel temp_penjualan
                $insert2 = "insert into detail_penjualan(no_struk,no_batch,harga,jumlah,total_harga) values('$no_struk','$rowcari[no_batch]','$row[harga]','$qty','$total')";
            mysql_query($insert2);
            $total_harga = $total_harga + $total; //digunakan untuk menghitung total harga untuk dimasikkan ke tabel PENJUALAN
                $sisa = $rowcari['stok'] - $qty; //digunakan untuk mengurangi stok di tabel batch
                $update2 = "update batch set stok='$sisa' where no_batch='$rowcari[no_batch]'";
            mysql_query($update2);
        } //tutup WHILE di LINE while($row=mysql_fetch_array($query)){?>

			
			<?php
            if ($query) {
                $update = "update penjualan set total_harga = '$total_harga', bayar = '$bayar' where no_struk = '$no_struk'";
                mysql_query($update);
                $hapus = "delete from temp_penjualan";
                mysql_query($hapus); ?>
					<script language="javascript">alert('Penjualan Telah dilakukan');
					document.location='penjualan/print_struk.php';
					</script>
					<br /><hr />
					
					<font size="-2">
					APOTEK TBS<br />Komp. GBA 2 blok M2 no.19<br />022-7532003<br /><br />
					
					<table border="0">
						<tr>
							<td>No Struk</td>
							<td>:</td> 
							<td><?php echo $no_struk; ?></td>
						</tr>
						<tr>
							<td>Kasir</td> 
							<td>:</td>
							<td><?php echo $username; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>:</td>
							<td><?php $tgl=date('d-m-Y');
                echo $tgl; ?></td>
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
                while ($row=mysql_fetch_array($eksekusi)) {
                    $nama_obat=$row['nama_obat'];
                    $jumlah=$row['jumlah'];
                    $harga=$row['harga'];
                    $total_harga=$row['total_harga']; ?>
							<tr>
								<td><?php echo $nama_obat; ?></td>
								<td align="center"><?php echo $jumlah; ?></td>
								<td align="right"><?php echo"".number_format($harga, 0, ",", ".").",00"; ?></td>
								<td align="right"><?php echo"".number_format($total_harga, 0, ",", ".").",00"; ?></td>
							</tr>
							<?php
                            $sqltotal = "select * from penjualan where no_struk='$no_struk'"; //digunakan untuk menampilkan total harga di struk
                            $query=mysql_query($sqltotal);
                    $row = mysql_fetch_array($query);
                    $total_harga = $row['total_harga']; ?>
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
							<td><?php echo"Rp. ".number_format($total_harga, 0, ",", ".").",00"; ?></td>
						</tr>
						<tr>
							<td>C A S H</td> 
							<td>:</td> 
							<td><?php echo"Rp. ".number_format($bayar, 0, ",", ".").",00"; ?></td>
						</tr>
						<tr>
							<td>C H A N G E</td> 
							<td>:</td> 
							<td><?php echo"Rp. ".number_format($bayar-$total_harga, 0, ",", ".").",00"; ?></td>
						</tr>
					</table>	
					<?php
                    echo("<br/>Terima Kasih<br />Semoga Lekas Sembuh"); ?>
				</font><?php

            } // TUTUP IF if($query)
                } // TUTUP ELSE di LINE else{ // JIKA UANG PEMBAYARAN CUKUP
            } //TUTUP IF if(isset($_POST['insert_penjualan'])
?>