<?php
//set_time_limit(30000);
include("../koneksi.php");

error_reporting(E_ALL ^ E_NOTICE);

if (isset($_GET['input'])) {
    $input = $_GET['input'];
    $query = "select kode_obat, nama_obat from obat where nama_obat like '%$input%' order by nama_obat asc";
    $eksquery = mysql_query($query);
    $hasil = mysql_num_rows($eksquery);
    if ($hasil > 0) {
        while ($data = mysql_fetch_row($eksquery)) {
            ?>
			<a href="javascript:autoInsert('<?=$data[0]?>');"><?=$data[1]?></a><br> <!– hasil search –>
			<?php

        }
    } else {
        echo "Nama Obat tidak ditemukan";
    }
}
?>