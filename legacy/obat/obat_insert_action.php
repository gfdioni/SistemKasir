<?php
include("koneksi.php");
$kode_obat            =$_POST['kode_obat'];
$nama_obat            =$_POST['nama_obat'];
$satuan                =$_POST['satuan'];
$harga                =$_POST['harga'];
$harga_langganan    =$_POST['harga_langganan'];
$stok_min            =$_POST['stok_min'];
$stok_min_etalase    =$_POST['stok_min_etalase'];
$rak                =$_POST['rak'];

// cek apakah kode obat yang di inputkan sudah ada atau belum?
$cek="SELECT kode_obat FROM OBAT where kode_obat='$kode_obat'";
$eksekusi_cek=mysql_query($cek);
$count=mysql_num_rows($eksekusi_cek);
if ($count>0) { // kondisi saat KODE_OBAT sudah ada?>
	<script language="JavaScript" type="text/javascript">
	alert("GAGAL! KODE OBAT SUDAH ADA");
	</script>
<?php 
} // END OF kondisi saat KODE_OBAT sudah ada

else { // kondisi saat KODE_OBAT belum ada
    $query="INSERT INTO OBAT(kode_obat,nama_obat,satuan,harga,harga_langganan,stok_min,stok_min_etalase,tgl_modifikasi,rak) VALUES ('$kode_obat','$nama_obat','$satuan','$harga','$harga_langganan','$stok_min','$stok_min_etalase',now(),'$rak')";
    $eksekusi=mysql_query($query);
    
    //masukkan data ke dalam detail_faktur
    $insert_df    = "insert into detail_faktur(no_faktur,kode_obat,no_batch,expired,jumlah,harga,diskon1,diskon2,diskon3,diskon4,tgl_obat_masuk,jam_obat_masuk)		values('1','$kode_obat','','0000-00-00','0','0','0','0','0','0',curdate(),curtime())";
    $query2        = mysql_query($insert_df);
    
    //ambil data obat dari tabel DETAIL_FAKTUR untuk dimasukkan ke tabel BATCH dan ETALASE
    $ambil_df        = "select * from detail_faktur where no_faktur='1' order by no_batch DESC";
    $eks_ambil_df    = mysql_query($ambil_df);
    $hasil_eks_df    = mysql_fetch_array($eks_ambil_df);
    
    $ambil_kode        = $hasil_eks_df['kode_obat'];
    $ambil_no_batch    = $hasil_eks_df['no_batch'];
    $ambil_expired    = $hasil_eks_df['expired'];
    $ambil_jumlah    = $hasil_eks_df['jumlah'];
    $ambil_tgl        = $hasil_eks_df['tgl_obat_masuk'];
    $ambil_jam        = $hasil_eks_df['jam_obat_masuk'];
    
    //insert data ke tabel BATCH dan ETALASE
    $insert_ke_tabel_batch    = "insert into batch values ('$ambil_kode','$ambil_no_batch','$ambil_expired','$ambil_jumlah','$ambil_tgl','$ambil_jam')";
    $insert_ke_tabel_etalase= "insert into etalase values ('$ambil_kode','$ambil_no_batch','$ambil_expired','$ambil_jumlah','$ambil_tgl','$ambil_jam','')";
    mysql_query($insert_ke_tabel_batch);
    mysql_query($insert_ke_tabel_etalase);
    
    if (isset($eksekusi)) {
        echo("
			DATA OBAT SUKSES DIMASUKKAN<br/><br/>
			<table>
				<tr>
					<td>Kode Obat</td>
					<td>:</td>
					<td>$kode_obat</td>	
				</tr>
				<tr>
					<td>Nama Obat</td>
					<td>:</td>
					<td>$nama_obat</td>	
				</tr>
				<tr>
					<td>Satuan</td>
					<td>:</td>
					<td>$satuan</td>	
				</tr>
				<tr>
					<td>Harga</td>
					<td>:</td>
					<td>$harga</td>	
				</tr>
				<tr>
					<td>Harga Langganan</td>
					<td>:</td>
					<td>$harga_langganan</td>	
				</tr>
				<tr>
					<td>Stok Minimal Gudang</td>
					<td>:</td>
					<td>$stok_min</td>	
				</tr>
				<tr>
					<td>Stok Minimal Etalase</td>
					<td>:</td>
					<td>$stok_min_etalase</td>	
				</tr>
				<tr>
					<td>No Rak</td>
					<td>:</td>
					<td>$rak</td>	
				</tr>
			</table>
			
			
			<br><a href=?page=obat_insert>Masukkan data obat lagi</a>	
		");
    } // END OF IF
    else {
        echo("Data Gagal Dimasukkan");
    } // END OF ELSE
} // END OF kondisi saat KODE_OBAT belum ada
?>
