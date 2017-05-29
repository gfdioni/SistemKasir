<?php
include("koneksi.php");

$no_struk	= $_POST['no_struk'];
$kode_obat 	= $_POST['kode_obat'];
$no_batch 	= $_POST['no_batch'];
$harga 		= $_POST['harga'];
$qty	 	= $_POST['qty'];
$id			= $_POST['id'];

$cek_qty		="select jumlah,total_harga,id_etalase,diskon from detail_penjualan where no_struk='$no_struk' and no_batch='$no_batch' and id='$id'";
$eks_cek_qty		= mysql_query($cek_qty);
$ambilqty			= mysql_fetch_row($eks_cek_qty);
$hasilqty			= $ambilqty[0];
$total_detail_penj	= $ambilqty[1];
$ambilideta			= $ambilqty[2];
$ambildiskon		= $ambilqty[3];

$cek_total_harga  		="select total_harga from penjualan where no_struk = '$no_struk'";
$eks_cek_total_harga 	= mysql_query($cek_total_harga);
$ambil 					= mysql_fetch_row($eks_cek_total_harga);
$hasil		 			= $ambil[0];

$querystok				="select stok,id from etalase where no_batch = '$no_batch' order by tgl_obat_masuk asc, jam_obat_masuk asc, id asc";
$eks_query_stok			= mysql_query($querystok);
$ambilstok				= mysql_fetch_row($eks_query_stok);
$hasilstok				= $ambilstok[0];
$hasilid				= $ambilstok[1];

$selisihqty				= $hasilqty-$qty;
$total_detail_penj_baru	= $harga*$qty-($harga*$qty*($ambildiskon/100));
$total_penjualan		= $hasil-(($harga*$selisihqty)-(($harga*$selisihqty)*($ambildiskon/100)));
$stokbaru				= $hasilstok+$selisihqty;

$query 		= "update detail_penjualan set jumlah = '$qty' where no_struk='$no_struk' and no_batch = '$no_batch' and id_etalase = '$ambilideta' and id='$id'";
$query2		= "update detail_penjualan set total_harga = '$total_detail_penj_baru' where no_struk='$no_struk' and no_batch = '$no_batch' and id_etalase = '$ambilideta' and id='$id'";
$query3		= "update penjualan set total_harga = '$total_penjualan' where no_struk='$no_struk'";
$query4		= "update etalase set stok = '$stokbaru' where no_batch = '$no_batch' and id='$hasilid'";
mysql_query($query);
mysql_query($query2);
mysql_query($query3);
mysql_query($query4);
?>
	<script language="javascript">
		alert('Penjualan telah diubah');
		document.location='index.php?page=penjualan_insert';
	</script>
	