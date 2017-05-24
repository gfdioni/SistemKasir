<h5>Halaman Retur</h5>

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);

$no_faktur=$_POST['no_faktur'];
$jumlah=@$_POST['jumlah'];

if ($no_faktur!="") {
    ?>
<form name="retur" method="post" onsubmit="return validate_form()" action="?page=retur"> <?php

        $sql="select f.tgl_faktur,f.total_harga,p.nama_pbf 
			from faktur f, pbf p, pemesanan pes 
			where pes.kode_pbf=p.kode_pbf 
			and pes.id_pesan=f.id_pesan 
			and f.no_faktur='$no_faktur'";
    $eks=mysql_query($sql);
    $row=mysql_fetch_array($eks); ?>
		
		<table>
			<tr>
				<td width="80">No Faktur</td>
				<td>:</td>
				<td><b><?php echo $no_faktur; ?></b></td>
				<input type="hidden" name="no_faktur" value="<?php echo $no_faktur; ?>" />
			</tr>
			<tr>
				<td>Tgl Faktur</td>
				<td>:</td>
				<td><?php echo date('d-m-Y', strtotime($row[0])); ?></td>
			</tr>
			<tr>
				<td>Dari PBF</td>
				<td>:</td>
				<td><b><?php echo $row[2]; ?></b></td>
			</tr>
			<tr>
				<td>Total Harga</td>
				<td>:</td>
				<td><b><?php echo"Rp. ".number_format($row[1], 0, ",", ".").",00"; ?></b></td>
			</tr>
		</table><br /><hr /><br />
		
		<table border="1">
			<tr bgcolor="#00FF00" align="center">
				<td width="30">No</td>
				<td width="100">Kode Obat</td>
				<td width="300">Nama Obat</td>
				<td width="70">Satuan</td>
				<td width="70">Harga Satuan</td>
				<td width="60">Jumlah Beli</td>
				<td width="70">No Batch</td>
				<td width="100">Expired</td>
				<td width="60">Diskon 1(%)</td>
				<td width="60">Diskon 2(%)</td>
				<td width="60">Diskon 3(%)</td>
				<td width="60">Diskon 4(%)</td>
				
			</tr>
			
		<?php
        $counter=1;
    $sql="select o.kode_obat,o.nama_obat,o.satuan,df.harga,df.jumlah,df.no_batch,df.expired,df.diskon1,df.diskon2,df.diskon3,df.diskon4 
		from faktur f, detail_faktur df, obat o 
		where f.no_faktur=df.no_faktur 
		and df.kode_obat=o.kode_obat 
		and f.no_faktur='$no_faktur'
		group by df.kode_obat";
    $eks=mysql_query($sql);
    while ($row=mysql_fetch_array($eks)) {
        echo("
			<tr align=center>
				<td align='center'>$counter</td>
				<td>$row[0]</td>
				<td>$row[1]</td>
				<td>$row[2]</td>")?>
				<td><?php echo number_format($row[3], 0, ",", "."); ?></td>
				<td><?php echo $row[4]; ?></td>
				<td><?php echo $row[5]; ?></td>
				<td><?php echo date('d-m-Y', strtotime($row[6])); ?></td> <?php echo("
				<td>$row[7]</td>
				<td>$row[8]</td>
				<td>$row[9]</td>
				<td>$row[10]</td>		
			</tr>
			");
        $counter++;
    } // tutup while($row=mysql_fetch_array($eks)){?>
		</table>
	<br />Masukkan item obat yang akan di retur : <input type="text" name="jumlah" value="<?php echo $jumlah; ?>" autocomplete="off" />
	<input type="submit" name="eks" value="RETUR" /><br /><br />

	<?php 
} //tutup if($no_faktur!="" || $no_faktur1!=""){

if (isset($_POST['eks'])) {
    ?>
		<b><font color="#FF0000">PASTIKAN JUMLAH RETUR BENAR!</font></b>
		<table border="1">
			<tr  bgcolor="#00FFFF">
				<td align="center" width="29">No</td>
				<td align="center" width="400">Nama Obat - Satuan</td>
				<td align="center" width="100">Jumlah Retur</td>
			</tr>
			
			<?php
            for ($i=1;$i<=$jumlah;$i++) {
                $nama_obat[$i]=@$_POST['nama_obat'.$i];
                $jumlah_obat[$i]=@$_POST['jumlah_obat'.$i];
            }
            
    for ($i=1;$i<=$jumlah;$i++) {
        ?>
				<tr>
					<td align="center"><?php echo $i; ?></td>
					<td>
						<select name="nama_obat<?php echo $i; ?>">
							<?php
                            $sql = "select 
							o.kode_obat,o.nama_obat,o.satuan,df.harga,df.jumlah,df.no_batch,df.expired,df.diskon1,df.diskon2,df.diskon3,df.diskon4
							from faktur f, detail_faktur df, obat o
							where f.no_faktur=df.no_faktur 
							and df.kode_obat=o.kode_obat 
							and f.no_faktur='$no_faktur'
							group by df.kode_obat"; //ambil data
                            $query=mysql_query($sql);
        while ($row=mysql_fetch_array($query)) {
            if ($row[0]==$nama_obat[$i]) {
                $select = "selected = 'selected'";
            } else {
                $select = "";
            }
            echo "<option value='$row[0]' $select>$row[1] - $row[2] - $row[3]</option>";
        } ?>
						</select>
					</td>
					<td><input type="text" name="jumlah_obat<?php echo $i; ?>" maxlength="3" value="<?php echo $jumlah_obat[$i]; ?>" autocomplete="off"/></td>
				</tr>	
			<?php

    } //tutup for($i=1;$i<=$jumlah;$i++)?>
		</table>
		<br /><input type="submit" name="confirm" value="CONFIRM RETUR" />
	<?php

} // tutup if(isset($_POST['eks']))?>
</form>

<?php
if (isset($_POST['confirm'])) {
    $no_faktur=$_POST['no_faktur'];
    //$jumlah=@$_POST['jumlah'];
    
    $total_retur=0;
    for ($i=1;$i<=$jumlah;$i++) {
        $nama_obat        =@$_POST['nama_obat'.$i];
        $jumlah_obat    =@$_POST['jumlah_obat'.$i]; //jumlah_obat adalah jumlah yang akan di retur
        
        $sql    = "select o.kode_obat,o.nama_obat,o.satuan,df.harga,df.jumlah,df.no_batch,df.expired,df.diskon1,df.diskon2,df.diskon3,df.diskon4
					from faktur f, detail_faktur df, obat o 
					where f.no_faktur=df.no_faktur 
					and o.kode_obat=df.kode_obat 
					and f.no_faktur='$no_faktur' 
					and o.kode_obat='$nama_obat'
					group by o.kode_obat";
        $query = mysql_query($sql);
        $row=mysql_fetch_array($query);
        $satuan        =$row[2];
        $harga        =$row[3];
        $jml_awal    =$row[4]; // jml_awal adalah jumlah obat asli di faktur
        $no_batch    =$row[5];
        //$expired	=$row[6];
        $diskon1    =$row[7];
        $diskon2    =$row[8];
        $diskon3    =$row[9];
        $diskon4    =$row[10];
        
        $insert    = "insert into retur (no_faktur,kode_obat,no_batch,satuan,jumlah,harga,diskon1,diskon2,diskon3,diskon4,id) values 
						('$no_faktur','$nama_obat','$no_batch','$satuan','$jumlah_obat','$harga','$diskon1','$diskon2','$diskon3','$diskon4','')";
        mysql_query($insert);
    } //tutup for($i=1;$i<=$jumlah;$i++){
    
        //ambil diskon ekstra dan ppn dari tabel faktur
        $sql="select diskon_ekstra,ppn from faktur where no_faktur = '$no_faktur'";
    $eks=mysql_query($sql);
    $row=mysql_fetch_array($eks);
    $hasildiskonekstra=$row[0];
    $hasilppn=$row[1];
        
        //ambil total harga dari tabel faktur
        $sql="select total_harga from faktur where no_faktur='$no_faktur'";
    $eks=mysql_query($sql);
    $row=mysql_fetch_array($eks);
    $hasiltotalharga=$row[0];
        
        //ambil id retur agar barang yang sudah di retur tidak terbaca lagi
        $sql="select id from retur where no_faktur='$no_faktur' order by id DESC";
    $eks=mysql_query($sql);
    $row=mysql_fetch_array($eks);
    $hasilid=$row[0]-$jumlah;
        
        //ambil semua row dari faktur
        $total_semua=0;
    $sql="select * from retur where no_faktur='$no_faktur' and id > '$hasilid'";
    $eks=mysql_query($sql);
    while ($row=mysql_fetch_array($eks)) {
        $kode_obat=$row['kode_obat'];
        $no_batch=$row['no_batch'];
        $jumlah=$row['jumlah'];
        $harga=$row['harga'];
        $diskon1=$row['diskon1'];
        $diskon2=$row['diskon2'];
        $diskon3=$row['diskon3'];
        $diskon4=$row['diskon4'];
        $id=$row['id'];
            
            // ambil stok awal dari tabel batch
            $sqlstokb="select stok from batch where no_batch='$no_batch'";
        $eksstokb=mysql_query($sqlstokb);
        $ambilstokb=mysql_fetch_array($eksstokb);
        $hasilstokb=$ambilstokb[0]; // ambil jumlah stok di satu batch dalam tabel detal faktur
            
            // ambil stok awal dari tabel detail faktur
            $sqlstok="select jumlah from detail_faktur where no_batch='$no_batch'";
        $eksstok=mysql_query($sqlstok);
        $ambilstok=mysql_fetch_array($eksstok);
        $hasilstok=$ambilstok[0]; // ambil jumlah stok di satu batch dalam tabel detal faktur
            
            // hitung selisih stok awal dan jumlah retur
            $selisih=$hasilstok-$jumlah_obat; //untuk update stok di detail_faktur dan detail_pembelian
            $selisihb=$hasilstokb-$jumlah_obat; //untuk update stok di tabel batch
            
            
            // update stok di semua tabel (det_faktur, det_pembelian, batch)
            $querybatch="update batch set stok='$selisihb' where no_batch='$no_batch'";
        $query_det_fak="update detail_faktur set jumlah='$selisih' where no_batch='$no_batch'";
        $query_det_pem="update detail_pembelian set jumlah='$selisih' where no_batch='$no_batch'";
        mysql_query($querybatch);
        mysql_query($query_det_fak);
        mysql_query($query_det_pem);
            
            // hitung harga baru untuk di tabel faktur dan pembelian
            $total_batal1    = $jumlah*$harga;
        $total_batal2    = $total_batal1 - ($total_batal1*($diskon1/100));
        $total_batal3    = $total_batal2 - ($total_batal2*($diskon2/100));
        $total_batal4    = $total_batal3 - ($total_batal3*($diskon3/100));
        $total_batal5    = $total_batal4 - ($total_batal4*($diskon4/100));
            
        $hp                = $total_batal5+($total_batal5*($hasilppn/100));//hp adalah perhitungan Harga Pajak
            $hde            = $hp-($hp*($hasildiskonekstra/100));//hde adalah perhitungan Harga Diskon Ekstra
            $total_semua    = $total_semua+$hde;
    } //tutup while($row=mysql_fetch_array($eks)){
        
        $total_baru = $hasiltotalharga-$total_semua;//hasil pengurangan total harga awal - total harga retur
        
        //update total harga di faktur dan pembelian
        $updatefaktur = "update faktur set total_harga='$total_baru' where no_faktur = '$no_faktur'";
    $updatepembelian = "update pembelian set total_harga='$total_baru' where no_faktur = '$no_faktur'";
    mysql_query($updatefaktur);
    mysql_query($updatepembelian); ?>
	<script language="javascript">
		alert('Retur Telah dilakukan');
		document.location='index.php?page=retur';
	</script>
	
	<?php

} // tutup if(isset($_POST['confirm'])){
?>