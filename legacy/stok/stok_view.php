<h5>Halaman Laporan Stok Obat di Gudang</h5>

<?php
include("koneksi.php");
error_reporting(E_ALL ^ E_NOTICE);
?>

<form method="post" action="?page=stok_view" name="gudang">
Masukkan Nama Obat : <input type="text" name="cari" autocomplete="off" autofocus>
<input type="submit" name="submit" value="CARI"><br>
</form>

<br /><h5>Warna Merah Artinya Stok Sekarang dibawah Stok Minimum Gudang</h5><br />
<b><a href="?page=stok_minimum">Lihat Obat Yang Sudah Harus Dipesan..</a></b><br />

<?php
if(isset($_POST['cari'])){
$cari=$_POST['cari']; ?>
<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width='50'>No</td>
		<td width='150'>Kode Obat</td>
		<td width='500'>Nama Obat</td>
		<td width='100'>Satuan</td>
		<td width='80'>Harga</td>
		<td width='80'>Harga Langganan</td>
		<td width='80'>Stok Minimum Gudang</td>
		<td width='80'>Stok Gudang Sekarang</td>
	</tr>
<?php	
//$query="SELECT O.KODE_OBAT,NAMA_OBAT,SATUAN,HARGA,SUM(STOK) FROM OBAT O, BATCH B WHERE O.KODE_OBAT=B.KODE_OBAT AND B.EXPIRED-CURDATE() >= 100 GROUP BY KODE_OBAT ORDER BY NAMA_OBAT";

$query="SELECT O.KODE_OBAT, NAMA_OBAT, SATUAN, HARGA, HARGA_LANGGANAN, SUM(STOK) FROM OBAT O, BATCH B WHERE O.KODE_OBAT=B.KODE_OBAT and (O.NAMA_OBAT LIKE '%$cari%' or O.KODE_OBAT LIKE '%$cari%' ) GROUP BY KODE_OBAT ORDER BY NAMA_OBAT ASC";
$tampil_data=mysql_query($query);
$counter=1;
while($data=mysql_fetch_row($tampil_data)){?>
	<tr align='center'> 
		<td><?php echo $counter; ?></td>
		<td><?php echo $data[0]; ?></td> 
		<td align='left'><?php echo $data[1]; ?></td> 
		<td><?php echo $data[2]; ?></td> 
		<td align = 'right'><?php echo number_format($data[3],0,",",".");?></td> 
		<td align = 'right'><?php echo number_format($data[4],0,",",".");?></td><?php
		//ambil stok minimum
		$query_stok_min	= "select stok_min from obat where kode_obat='$data[0]'";
		$eks_stok_min 	= mysql_query($query_stok_min);
		$ambil_stok_min	= mysql_fetch_array($eks_stok_min);
		$hasil_stok_min	= $ambil_stok_min[0];?>
		<td><?php echo $hasil_stok_min;?></td>
			<?php 
			$sekarang=$data[5];
			if($sekarang < $hasil_stok_min){?>
				<td width="100" align="center" bgcolor="red"><?php echo $data[5]; ?></td><?php
			}
			else{?>
				<td width="100" align="center"><?php echo $data[5]; ?></td><?php
			}
		$counter++;?>
	</tr>
<?php
}//tutup while($data=mysql_fetch_row($tampil_data)){ ?>
</table>

<?
} //tutup if(isset($_POST['cari']))
?>
<br /><hr />

<?php
include("footer.php");
?>