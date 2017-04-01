<?php
//set_time_limit(30000);
include("../koneksi.php");

$jumlah=@$_POST['jumlah'];
error_reporting(E_ALL ^ E_NOTICE);
?>

				<?php
				if (isset($_GET['input'])){
					$input = $_GET['input'];
					//$query = "select batch.kode_obat, obat.nama_obat, batch.kode_obat, sum(stok) from obat, batch where obat.nama_obat like '%$input%' AND obat.kode_obat=batch.kode_obat AND batch.expired-curdate()>= 100 group by kode_obat having sum(stok)>0 order by obat.nama_obat";
					//$query = "select etalase.kode_obat, obat.nama_obat, etalase.kode_obat, sum(stok) from obat, etalase where obat.nama_obat like '%$input%' AND obat.kode_obat=etalase.kode_obat group by kode_obat order by obat.nama_obat";
					$query = "select * from obat where nama_obat like '%$input%' order by nama_obat";
					$eksquery = mysql_query($query);
					$hasil = mysql_num_rows($eksquery);
					if ($hasil > 0){
						while ($data = mysql_fetch_row($eksquery)){
							?>
							<a href="javascript:autoInsert('<?=$data[0]?>');"><?=$data[1]?></a><br> <!– hasil search –>
							<?php
						}
					}
					else{
					echo "Nama Obat tidak ditemukan";
					}
				}
				
				?>