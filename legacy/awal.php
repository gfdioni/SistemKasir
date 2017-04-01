<h5>Selamat Datang</h5>
<?php
	include("koneksi.php");
	$query = "select * from awal";
	$eks = mysql_query($query);
	while($hasil = mysql_fetch_row($eks)){
		echo $hasil[1];
	}
	
	if($jabatan=="pemilik"){
	?>
		<form method="post" action="?page=awal">
		<br /><input type="submit" value="update" name="update" />
			<?php
			if(isset($_POST['update'])){
				$query = "select * from awal";
				$eks = mysql_query($query);
				while($hasil = mysql_fetch_row($eks)){?>
					<br /><br /><textarea name="update" cols="50"><?php echo $hasil[1]; ?></textarea>
					<br /><input type="submit" value="simpan" name="update2" />
					<?php
					if(isset($_POST['update2'])){
						$update = "update awal set isi='$_POST[update]'";
						mysql_query($update);
						?><script>document.location='index.php?page=home';</script><?php
					}
				}?>	
			<?php	
			}
			?>
		</form>
	<?php
	}else{
	
	}
include("footer.php");
?>
