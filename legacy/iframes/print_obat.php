<?php
include("../koneksi.php");

$cari = $_GET['cari'];
echo "Data Obat dengan keyword = ' $cari '";?>

<br /><br />
<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width='50'>No</td>
		<td width='150'>Kode Obat</td>
		<td width='450'>Nama Obat</td>
		<td width='80'>Satuan</td>
		<td width='80'>Harga</td>
		<td width='80'>Harga Langganan</td>
		<td width='80'>Stok Minimum Gudang</td>
		<td width='80'>Stok Minimum Etalase</td>
		<td width='80'>No Rak Etalase</td>
	</tr>
	<?php
    $query="SELECT * FROM OBAT where nama_obat like '%$cari%' OR kode_obat like '%$cari%' ORDER BY nama_obat";
    $tampil_data=mysql_query($query);
    $counter=1;
    while ($data=mysql_fetch_row($tampil_data)) {
        ?>
		<tr align='center'> 
			<td width='50'><?php echo $counter; ?></td>
			<td width='150'><?php echo $data[0]; ?></td> 
			<td width='450' align='left'><?php echo $data[1]; ?></td> 
			<td width='80'><?php echo$data[2]; ?></td> 
			<td width='80' align='right'><?php echo number_format($data[3], 0, ",", "."); ?></td> 
			<td width='80' align='right'><?php echo number_format($data[4], 0, ",", "."); ?></td> 
			<td width='80'><?php echo $data[5]; ?></td> 
			<td width='80'><?php echo $data[6]; ?></td>
			<td width='80'><?php echo $data[8]; ?></td> 
		</tr><?php
        $counter++;
    } // TUTUP while($data=mysql_fetch_row($tampil_data)){?>
</table>