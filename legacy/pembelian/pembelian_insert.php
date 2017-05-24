<h5>Halaman Pembelian Obat</h5>

<script language="javascript" type="text/javascript">
function validate_form ()
{
    valid = true;
	var angka = /^[0-9]+$/;
	
	if ( document.pemesanan.id_pesan.value == "" )
    {
        alert ( "ID Pesan belum diisi" );
        valid = false;
    }
	if ( !document.pemesanan.id_pesan.value.match(angka) )
    {
        alert ( "ID Pesan harus angka." );
        valid = false;
    }
	
    return valid;
}
</script>

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
	if ( !document.faktur.no_faktur.value.match(angka) )
    {
        alert ( "Nomor Faktur harus angka." );
        valid = false;
    }
	
	 return valid;
}
</script>

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);

$no_faktur        =@$_GET['no_faktur'];
$ppn            =@$_GET['ppn']; // mengambil ppn dari form sebelumnya
$ppn1            =@$_POST['ppn']; // mengirim ppn untuk form selanjuatnya
//$diskon_ekstra	=@$_GET['diskon_ekstra']; // mengambil ppn dari form sebelumnya

?>

<?php
    if ($no_faktur != "") {
        $sql = "select * from faktur where no_faktur = '$no_faktur'";
        $eks = mysql_query($sql);
        $row = mysql_fetch_array($eks); ?>
		<font color="#3333FF" size="4"><center> KONFIRMASI PEMBELIAN OBAT</center></font>
		<form name="faktur" action="?page=pembelian_insert" method="post">
		<input type="hidden" name="no_faktur" value="<?php echo $row['no_faktur']; ?>">
		<input type="hidden" name="tgl_jatuh_tempo" value="<?php echo $row['tgl_jatuh_tempo']; ?>">
		<input type="hidden" name="ppn" value="<?php echo $ppn; ?>" />
		<input type="hidden" name="diskon_ekstra" value="<?php echo $row['diskon_ekstra']; ?>" />
		
		<table>
			<tr>
				<td width="100">ID Pesan</td> 
				<td>: <?php echo $row['id_pesan']; ?></td>
			</tr>
			<tr>
				<td>No Faktur</td> 
				<td>: <b><?php echo $row['no_faktur']; ?></b></td>
			</tr>
			<tr>
				<td>Tgl JT</td>
				<td>: <?php echo date('d-m-Y', strtotime($row['tgl_jatuh_tempo'])); ?></td>
			</tr>
			<tr>
				<td>Diskon Ekstra</td>
				<td>: <?php echo $row['diskon_ekstra']; ?> %</td>
			</tr>
			<tr>
				<td>PPN</td>
				<td>: <?php echo $row['ppn']; ?> %</td>
			</tr>
			<tr>
				<td>Total Harga</td>
				<td>: <b><?php echo"Rp. ".number_format($row['total_harga'], 0, ",", ".").",00"; ?></b></td>
			</tr>
		</table>
		<br />
			
		<table border="1" align="center">
			<tr align="center" bgcolor="#0099CC">
				<td width="30">No</td>
				<td width="400">Nama Obat</td>
				<!--<td width="50">No Batch</td>-->
				<td width="80">Expired</td>
				<td width="50">Jumlah Yang Dikirim</td>
				<td width="50">Jumlah Yang Dibeli</td>
				<td width="50">Harga Satuan</td>
				<td width="50">Diskon 1(%)</td>
				<td width="50">Diskon 2(%)</td>
				<td width="50">Diskon 3(%)</td>
				<td width="50">Diskon 4(%)</td>
			</tr>
		<?php
        $sql = "select no_faktur, o.nama_obat, df.kode_obat, no_batch, expired, jumlah, df.harga, diskon1, diskon2, diskon3, diskon4, tgl_obat_masuk, jam_obat_masuk 
		from detail_faktur df, obat o 
		where df.kode_obat = o.kode_obat AND no_faktur='$no_faktur'";
        $eks = mysql_query($sql);
        $no=1;
        while ($row=mysql_fetch_array($eks)) {
            ?>
			<tr align="center">
				<td><?php echo $no; ?></td>
				<td><?php echo $row['nama_obat']; ?></td>
				<!--<td><input type="text" size="2" name="no_batch<?php //echo $row['no_faktur']?>kode<?php //echo $row['kode_obat']?>" value="<?php //echo $row['no_batch']?>" /></td>-->
				<td><input type="text" size="10" name="expired<?php echo $row['no_faktur'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['expired']; ?>" /></td>
				<td><?php echo $row['jumlah']; ?></td>
				<td><input type="text" size="2" name="jumlah<?php echo $row['no_faktur'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['jumlah'] ?>" /></td>
				<td><input type="text" size="5" name="harga<?php echo $row['no_faktur'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['harga'] ?>" /></td>
				<td><input type="text" size="5" name="diskon1<?php echo $row['no_faktur'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['diskon1'] ?>" /></td>
				<td><input type="text" size="5" name="diskon2<?php echo $row['no_faktur'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['diskon2'] ?>" /></td>
				<td><input type="text" size="5" name="diskon3<?php echo $row['no_faktur'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['diskon3'] ?>" /></td>
				<td><input type="text" size="5" name="diskon4<?php echo $row['no_faktur'] ?>kode<?php echo $row['kode_obat'] ?>" value="<?php echo $row['diskon4'] ?>" /></td>
			</tr>
			
		<?php
            $no++;
        } // tutup while di LINE while($row=mysql_fetch_array($eks)){?>
		
		</table><br />	<!--TUTUP TABLE di LINE-->	
		
		<input type="radio" name="status_bayar" value="1" />CASH<br />
		<input type="radio" name="status_bayar" value="2" />TIDAK CASH<br />
		
		<br /><font size="2">* Tanggal Pembelian dan total harga akan di-generate secara otomatis</font><br />
		<font color="#FF0000"><b>PENTING : KLIK BATAL JIKA DATA FAKTUR YANG DIINPUTKAN SALAH, DAN ULANGI INPUT FAKTUR! </b><br /><br />
		<input type="submit" value="CONFIRM" name="confirm"/>	
		<input type="submit" value="BATAL" name="batal"/>		
	</form> <!--tutup <form name="faktur" action="?page=faktur_insert" method="post" onsubmit="return validate_form2();">-->
	
	<?php

    } // tutup IF di LINE if($no_faktur != ""){
    
    //--------------------------------------------------------JIKA TOMBOL CONFIRM DITEKAN----------------------------------------------------
    if (isset($_POST['confirm'])) {
        $status_bayar = $_POST['status_bayar'];
        $ppn = $_POST['ppn'];
        if ($ppn==1) {
            $besarppn=0;
        } else {
            $besarppn=10;
        }
        
        $no_faktur = $_POST['no_faktur'];
        $tgl_jatuh_tempo = $_POST['tgl_jatuh_tempo'];
        $username = $_SESSION['username'];
        $diskon_ekstra    = $_POST['diskon_ekstra'];
        
        $insert = "insert into pembelian (no_faktur,tgl_beli,tgl_jatuh_tempo,username,diskon_ekstra,ppn) values ('$no_faktur',curdate(),'$tgl_jatuh_tempo','$username','$diskon_ekstra','$besarppn')";
        $query = mysql_query($insert);
    
        $sql = "select no_faktur, o.nama_obat, df.kode_obat, no_batch, expired, jumlah, df.harga, diskon1, diskon2, diskon3, diskon4, tgl_obat_masuk, jam_obat_masuk from detail_faktur df, obat o where df.kode_obat = o.kode_obat AND no_faktur='$no_faktur'";
        $query=mysql_query($sql);
        $total = 0;
        while ($row=mysql_fetch_array($query)) {
            $kode_obat = $row['kode_obat'];
            //$no_batch = $_POST['no_batch'.$no_faktur.'kode'.$kode_obat] ;
            $no_batch    = $row['no_batch'];
            $expired    = $_POST['expired'.$no_faktur.'kode'.$kode_obat] ;
            $jumlah    = $_POST['jumlah'.$no_faktur.'kode'.$kode_obat] ;
            $harga        = $_POST['harga'.$no_faktur.'kode'.$kode_obat] ;
            $diskon1    = $_POST['diskon1'.$no_faktur.'kode'.$kode_obat] ;
            $diskon2    = $_POST['diskon2'.$no_faktur.'kode'.$kode_obat] ;
            $diskon3    = $_POST['diskon3'.$no_faktur.'kode'.$kode_obat] ;
            $diskon4    = $_POST['diskon4'.$no_faktur.'kode'.$kode_obat] ;
            
            if ($jumlah>0) {
                $subtotal1 = $harga*$jumlah;
                $subtotal2 = $subtotal1 - ($subtotal1*($diskon1/100));
                $subtotal3 = $subtotal2 - ($subtotal2*($diskon2/100));
                $subtotal4 = $subtotal3 - ($subtotal3*($diskon3/100));
                $subtotal5 = $subtotal4 - ($subtotal4*($diskon4/100));
                
                $insert3="insert into batch (kode_obat,no_batch,expired,stok,tgl_obat_masuk,jam_obat_masuk) values 
						('$kode_obat','$no_batch','$expired','$jumlah',curdate(),curtime())";
                $query3=mysql_query($insert3);
                $insert2="insert into detail_pembelian(no_faktur,kode_obat,no_batch,expired,jumlah,harga,diskon1,diskon2,diskon3,diskon4,tgl_obat_masuk,jam_obat_masuk)	values('$no_faktur','$kode_obat','$no_batch','$expired','$jumlah','$harga','$diskon1','$diskon2','$diskon3','$diskon4',curdate(),curtime())";
                $query2=mysql_query($insert2);
            } // tutup if($jumlah>0){
            $total = $total + $subtotal5;
        } // tutup WHLIE di LINE while($row=mysql_fetch_array($query)){
        //PERHITUNGAN PPN
            //$ppn = $_POST['ppn'];
            if ($ppn1 == 1) {
                $total = $total-($total*($diskon_ekstra/100));
            } else {
                $total = ($total + ($total*(10/100)))-($total + ($total*(10/100)))*($diskon_ekstra/100);
            }
        $update = "update pembelian set total_harga = '$total' where no_faktur = '$no_faktur'";
        mysql_query($update);
        
        //BILA PEMBAYARAN CASH, LAKUKAN INSERT KE TABEL PEMBAYARAN
            if ($status_bayar == 1) {
                $status_byr = "insert into pembayaran values ('$no_faktur',curdate(),curtime(),'$username')";
                mysql_query($status_byr);
            }
        
        if ($query) {
            ?>
			<script language="javascript">
				alert('Pembelian Telah dilakukan, Stok Obat Telah Bertambah');
				<?php echo("document.location='index.php?page=laporan_pengiriman&no_faktur=$no_faktur&ppn1=$ppn1'"); ?>
			</script>
			<?php

        } // tutup if di LINE if($query){
    } // tutup IF di LINE if(isset($_POST['confirm'])){
    
    //---------------------------------------------------------------JIKA TOMBOL BATAL DITEKAN---------------------------------------------------
    if (isset($_POST['batal'])) {
        $no_faktur = $_POST['no_faktur'];
        $query_hapus_df        = "delete from detail_faktur where no_faktur = '$no_faktur'";
        mysql_query($query_hapus_df);
        $query_hapus_faktur    = "delete from faktur where no_faktur = '$no_faktur'";
        $eks_query_hapus_faktur = mysql_query($query_hapus_faktur);
        
        if ($eks_query_hapus_faktur) {
            ?>
			<script language="javascript">
				alert('PROSES DIBATALKAN ! SILAHKAN ULANGI INPUT FAKTUR');
				<?php echo("document.location='index.php?page=faktur_insert'"); ?>
			</script>
			<?php

        } // tutup if di LINE if($query){
    } // tutup IF di LINE if(isset($_POST['batal'])){
    
?>