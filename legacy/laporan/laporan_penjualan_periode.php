<h5>Laporan Penjualan Harian</h5>
<?php
include("koneksi.php");
$tgl=date('Y-m-d');
?>

<form method="post" action="?page=laporan_penjualan_periode">
Pilih Kasir = 
<select name="kasir">
	<?php
    $sql = "select username from karyawan";
    $query=mysql_query($sql);
    while ($row=mysql_fetch_array($query)) {
        echo "<option value='$row[0]' $select>$row[0]</option>";
    }
    ?>
</select>
<input type="submit" name="submit" value="LIHAT" />
</form>

<?php
if (isset($_POST['submit'])) {
        $kasir = $_POST['kasir'];

//------------------------------------------------LAPORAN PENJUALAN HARIAN CASH------------------------------------------------------------------?>
<br />
Laporan Penjualan tanggal : <b><?php echo date('d-m-Y', strtotime($tgl)); ?></b><br />
Kasir : <b><?php echo $kasir; ?></b><br /><br />
<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width='150'>Kode Obat</td>
		<td width='400'>Nama Obat</td>
		<td width='100'>Satuan</td>
		<td width='150'>Jumlah Yang Dijual</td>
	<tr>

<?php


echo "<b>Penjualan Cash</b><br/><br/>";
        $query="select o.kode_obat, o.nama_obat, o.satuan, sum(dp.jumlah) from obat o, detail_penjualan dp, penjualan p, batch b
	where dp.no_struk = p.no_struk AND dp.no_batch = b.no_batch AND b.kode_obat = o.kode_obat AND p.tgl_jual like '$tgl' AND p.username = '$kasir' AND p.no_kartu='0' group by o.kode_obat";
        $eksekusi=mysql_query($query);
        while ($data=mysql_fetch_row($eksekusi)) {
            echo("	
				<tr align='center'> 
					<td>$data[0]</td> 
					<td>$data[1]</td> 
					<td>$data[2]</td> 
					<td>$data[3]</td>
				</tr>
		");
        } //END OF WHILE?>
</table>

<?php
// MENGHITUNG TOTAL PENJUALAN PERIODE INI DALAM RUPIAH
    $cash=0;
        $total_harga="SELECT SUM(dp.TOTAL_HARGA) FROM DETAIL_PENJUALAN DP, PENJUALAN p WHERE p.no_struk = dp.no_struk AND p.TGL_JUAL LIKE '$tgl' AND p.username='$kasir' AND p.no_kartu='0'";
        $hitung=mysql_query($total_harga);
        while ($data=mysql_fetch_row($hitung)) {
            //echo("<br/>Total Penjualan Obat Periode ini adalah = Rp $data[0]");
        echo("<br/>Total Penjualan Obat Cash adalah = <b>Rp. ".number_format($data[0], 0, ",", ".").",00 </b> ");
        //echo"Rp. ".number_format($data[0],0,",",".").",00";
        $cash=$cash+$data[0];
        }
    // SELESAI MENGHITUNG

//------------------------------------------------LAPORAN PENJUALAN HARIAN DEBIT------------------------------------------------------------------?>

<table border='1'>
	<tr align='center' bgcolor='cyan'>
		<td width='150'>Kode Obat</td>
		<td width='400'>Nama Obat</td>
		<td width='100'>Satuan</td>
		<td width='150'>Jumlah Yang Dijual</td>
	<tr>

<?php
echo("<br/><br/><hr/><b>Penjualan Debit</b><br/><br/>");
        $query1="select o.kode_obat, o.nama_obat, o.satuan, sum(dp.jumlah) from obat o, detail_penjualan dp, penjualan p, batch b
	where dp.no_struk = p.no_struk AND dp.no_batch = b.no_batch AND b.kode_obat = o.kode_obat AND p.tgl_jual like '$tgl' AND p.username = '$kasir' AND p.no_kartu!='0' group by o.kode_obat";
        $eksekusi1=mysql_query($query1);
        while ($data1=mysql_fetch_row($eksekusi1)) {
            echo("	
				<tr align='center'> 
					<td>$data1[0]</td> 
					<td>$data1[1]</td> 
					<td>$data1[2]</td> 
					<td>$data1[3]</td>
				</tr>
		");
        } //END OF WHILE?>
</table>

<?php
// MENGHITUNG TOTAL PENJUALAN PERIODE INI DALAM RUPIAH
    $debit=0;
        $total_harga1="SELECT SUM(dp.TOTAL_HARGA) FROM DETAIL_PENJUALAN DP, PENJUALAN p WHERE p.no_struk = dp.no_struk AND p.TGL_JUAL LIKE '$tgl' AND p.username='$kasir' AND p.no_kartu!='0'";
        $hitung1=mysql_query($total_harga1);
        while ($data1=mysql_fetch_row($hitung1)) {
            //echo("<br/>Total Penjualan Obat Periode ini adalah = Rp $data1[0]");
        echo("<br/>Total Penjualan Obat Debit adalah = <b>Rp. ".number_format($data1[0], 0, ",", ".").",00 </b> ");
        //echo"Rp. ".number_format($data1[0],0,",",".").",00";
        $debit=$debit+$data1[0];
        }
    // SELESAI MENGHITUNG?>
	
	<br /><br /><b>TOTAL PENJUALAN HARI INI DARI KASIR <font color="red"><?php echo $kasir ?></font> = <font color="red"><?php echo "Rp. ".number_format($cash+$debit, 0, ",", ".").",00"; ?></font></b>

<?php	
    } //tutup if(isset($_POST['submit'])){
?>

