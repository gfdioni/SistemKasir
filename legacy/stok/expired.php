<h5>Halaman Laporan Obat Expired</h5>
<hr />
<?php
include("koneksi.php");
?>
<!-- ----------------------------------------OBAT DI GUDANG------------------------------------------------- -->
<b>OBAT DI GUDANG</b>
<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width='30'>No</td>
		<td width='150'>Kode Obat</td>
		<td width='450'>Nama Obat</td>
		<td width='80'>Satuan</td>
		<td width='80'>No Batch</td>
		<td width='150'>Tgl Expired</td>
		<td width='50'>QTY</td>
		<td width='150'>Akan expired dalam (hari)</td>
		<td width='150'>Dari No Faktur</td>
	</tr> <?php
$query="SELECT B.KODE_OBAT, O.NAMA_OBAT, O.SATUAN, B.NO_BATCH, B.EXPIRED, B.STOK, B.EXPIRED-CURDATE()  FROM BATCH B, OBAT O WHERE B.KODE_OBAT = O.KODE_OBAT AND B.EXPIRED-CURDATE() < 100 AND B.STOK>0 GROUP BY B.NO_BATCH ORDER BY O.NAMA_OBAT ASC ";
$tampil_data=mysql_query($query);
$hitung=mysql_num_rows($tampil_data);
$counter=1;
if ($hitung > 0) {
    while ($data=mysql_fetch_row($tampil_data)) {
        ?>
		<tr align='center'>
			<td><?php echo $counter; ?></td> 
			<td><?php echo $data[0]; ?></td> 
			<td align='left'><?php echo $data[1]; ?></td> 
			<td><?php echo $data[2]; ?></td> 
			<td><?php echo $data[3]; ?> </td>
			<td><?php echo date('d-m-Y', strtotime($data[4])); ?></td>
			<td><?php echo $data[5]; ?></td> 
			<td><?php echo $data[6]; ?></td>  <?php
            //ambil no faktur
            $query_faktur        ="select no_faktur from detail_faktur where no_batch='$data[3]'";
        $eks_query_faktur    =mysql_query($query_faktur);
        $ambil_query        =mysql_fetch_array($eks_query_faktur);
        $hasil_query        =$ambil_query[0]; ?>
			<td><?php echo $hasil_query; ?></td> <?php

            $counter++; ?>
		</tr><?php 
    }// tutup while($data=mysql_fetch_row($tampil_data))
}// tutup if($hitung > 0
else {
    echo("Tidak ada obat yang akan kadaluarsa<br/><br/>");
}?>
</table>

<!-- ----------------------------------------OBAT DI ETALASE------------------------------------------------- -->
<br /><br /><b>OBAT DI ETALASE</b>
<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width='30'>No</td>
		<td width='150'>Kode Obat</td>
		<td width='450'>Nama Obat</td>
		<td width='80'>Satuan</td>
		<td width='80'>No Batch</td>
		<td width='150'>Tgl Expired</td>
		<td width='50'>QTY</td>
		<td width='150'>Akan expired dalam (hari)</td>
		<td width='150'>Dari No Faktur</td>
	</tr> <?php
$query1="SELECT E.KODE_OBAT, O.NAMA_OBAT, O.SATUAN, E.NO_BATCH, E.EXPIRED, E.STOK, E.EXPIRED-CURDATE()  FROM ETALASE E, OBAT O WHERE E.KODE_OBAT = O.KODE_OBAT AND E.EXPIRED-CURDATE() < 100 AND E.STOK>0 GROUP BY E.NO_BATCH ORDER BY O.NAMA_OBAT ASC ";
$tampil_data1=mysql_query($query1);
$hitung1=mysql_num_rows($tampil_data1);
$counter1=1;
if ($hitung1 > 0) {
    while ($data1=mysql_fetch_row($tampil_data1)) {
        ?>
		<tr align='center'>
			<td><?php echo $counter1; ?></td> 
			<td><?php echo $data1[0]; ?></td> 
			<td align='left'><?php echo $data1[1]; ?></td> 
			<td><?php echo $data1[2]; ?></td> 
			<td><?php echo $data1[3]; ?> </td>
			<td><?php echo date('d-m-Y', strtotime($data1[4])); ?></td>
			<td><?php echo $data1[5]; ?></td> 
			<td><?php echo $data1[6]; ?></td>  <?php
            //ambil no faktur
            $query_faktur1        ="select no_faktur from detail_faktur where no_batch='$data1[3]'";
        $eks_query_faktur1    =mysql_query($query_faktur1);
        $ambil_query1        =mysql_fetch_array($eks_query_faktur1);
        $hasil_query1        =$ambil_query1[0]; ?>
			<td><?php echo $hasil_query1; ?></td> <?php

            $counter1++; ?>
		</tr><?php 
    }// tutup while($data=mysql_fetch_row($tampil_data))
}// tutup if($hitung > 0
else {
    echo("Tidak ada obat yang akan kadaluarsa<br/><br/>");
}?>
</table>