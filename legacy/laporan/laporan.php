<h5>Halaman Laporan</h5>
<?php
include("koneksi.php");
?>

<form method="post" action="?page=laporan_action">
Pilih laporan : <select name="pilih_laporan">
					<option value="pembelian">Pembelian</option>
					<option value="penjualan">Penjualan</option>
				</select>
<br /><br />
Pilih Periode : <br />
Bulan <select size="1" name="bulan">
		<option value="Januari">Januari</option>
		<option value="Februari">Februari</option>
		<option value="Maret">Maret</option>
		<option value="April">April</option>
		<option value="Mei">Mei</option>
		<option value="Juni">Juni</option>
		<option value="Juli">Juli</option>
		<option value="Agustus">Agustus</option>
		<option value="September">September</option>
		<option value="Oktober">Oktober</option>
		<option value="November">November</option>
		<option value="Desember">Desember</option>		
	</select>
Tahun <select size="1" name="tahun">
		<option value="2012">2012</option>
		<option value="2013">2013</option>
		<option value="2014">2014</option>
		<option value="2015">2015</option>
		<option value="2016">2016</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
		<option value="2021">2021</option>
		<option value="2022">2022</option>
		<option value="2023">2023</option>
		<option value="2024">2024</option>
		<option value="2025">2025</option>
	</select>
<input type="submit" value="Lihat Laporan" name="lihat" /><br /><br /><hr /><br />
</form>