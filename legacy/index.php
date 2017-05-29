<?php
session_start();
$jabatan=@$_SESSION['jabatan'];
$usernamee=@$_SESSION['username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Sistem Informasi Apotek TBS</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
		
    	<script src="jquery-1.4.4.min.js" type="text/javascript"></script>
    	<script src="jquery.printPage.js" type="text/javascript"></script>

 	 	<script>  
  		$(document).ready(function() {
    	$(".btnPrint").printPage();
  		});
  		</script>
		
    </head>
    <body>
  		<div id="header">
			<div id="menu">
				<?php
					if($jabatan=="pemilik"){
					?>
						<ul>
							<li><a href="?page=awal">Home</a></li>
							<li><a href="?page=obat_view">Obat</a></li>
							<li><a href="?page=stok_view">Stok Gudang</a></li>
							<li><a href="?page=stok_view_etalase">Stok Etalase</a></li>
							<li><a href="?page=mutasi">Mutasi</a></li>				
							<li><a href="?page=cek_produk">Cek Produk</a></li>
							<li><a href="?page=penjualan_insert">P Umum</a></li>
							<li><a href="?page=penjualan_update">Edit Penjualan</a>
							<li><a href="?page=laporan_penjualan_periode">Penjualan Harian</a></li>
							<li><a href="?page=laporan">Laporan</a></li>
							<li><a href="?page=penjualan_insert_dokter">P Dokter</a></li>
							<li><a href="?page=penjualan_faktur">Faktur Penjualan</a></li>
							<li><a href="?page=resep">Resep</a></li>
						</ul>
					
					<?php
					}else if($jabatan=="supervisor"){
					?>
						<ul>
							<li><a href="?page=awal">Home</a></li>
							<li><a href="?page=pbf_view">PBF</a></li>
							<li><a href="?page=stok_view">Stok Gudang</a></li>
							<li><a href="?page=stok_view_etalase">Stok Etalase</a></li>
							<li><a href="?page=pemesanan_insert">Pemesanan</a></li>
							<li><a href="?page=faktur_insert">Faktur</a></li>
							<li><a href="?page=pembayaran_insert">Pembayaran</a></li>
							<li><a href="?page=kartu_stok">Krt Stok Masuk</a></li>
							<li><a href="?page=kartu_stok_keluar">Krt Stok Keluar</a></li>
							<!-- <li><a href="?page=mutasi">Mutasi</a></li> -->
							<li><a href="?page=retur_cari">Retur</a></li>
							<li><a href="?page=cek_produk">Cek Produk</a></li>
						</ul>
					
					<?
					}else if($jabatan=="kasir"){
					?>
						<ul>
							<li><a href="?page=awal">Home</a></li>
							<li><a href="?page=penjualan_insert">P Umum</a></li>
							<!--<li><a href="?page=penjualan_insert_langganan">P Langganan</a></li>-->
							<li><a href="?page=penjualan_insert_dokter">P Dokter</a></li>
							<li><a href="?page=cek_produk">Cek Produk</a></li>
							<li><a href="?page=resep">Resep</a></li>
							<!-- <li><a href="?page=penjualan_update">Edit Penjualan</a></li> -->
						</ul>
					
					<?php
					}else{
					?>
						<ul>
							<li><a href="?page=awal">Home</a></li>
							<li><a href="?page=login">Login</a></li>		
						</ul>

					<?php
					}
				?>
			</div>
			<div id="logo">
				<h1><a href="#">Apotek TRIDAYA BUANA SEJAHTERA (TBS)</a></h1>
		        <a href="#"><small>Web Based Information System</small></a>
				
			</div>
		</div>
	<!--<div id="prew_box">
			
			
<div id="wrapper">
        <div id="slider-wrapper">        
            <div id="slider" class="nivoSlider">
				<img src="images/gambar3.jpg" alt="" />
				<img src="images/gambar4.jpg" alt="" />
            </div>        
        </div>
</div>

<script type="text/javascript" src="lib/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="lib/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script>
			
		</div>-->
		<div class="razd"></div>
		
		<div id="content">
			<div id="left">
				<?php
					include "menu.php";
				?>
			</div>
			
			<div class="clear"></div>
		</div>
		<div class="razd"></div>
		
		<!--ini adalah kotak informasi-->
		<div id="right">
				<div class="right_grad_box right_pad">
					<div class="right_bg_top"></div>
					<div class="right_bg">
						<h5>Informasi</h5>
						<?php 
						if($usernamee!=""){?>
							<table border="0">
								<tr>
									<td>Username</td>
									<td>:</td>
									<td><?php echo $usernamee; ?></td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td><?php echo $jabatan; ?></td>
								</tr>
							</table>
							<br />Jangan lupa <a href="?page=logout">logout</a> setelah menggunakan aplikasi
							<?php 
							echo("<br /><a href=\"?page=karyawan_update&username=$usernamee\">Ganti Password Saya</a><br>");
							
							if($jabatan == "pemilik"){
								echo("<br /><strong><a href=\"?page=karyawan_view\">Kelola Akun User</a></strong><br>");
								echo("<strong><a href=\"?page=expired\">lihat Obat Kadaluwarsa</a></strong><br>");
							}
						} // tutup if di line if($usernamee!=""){
						?>
						<br /><br />
						
						<div align="center"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="184" height="51" title="jam">
                          <param name="movie" value="jam.swf" />
                          <param name="quality" value="high" />
                          <embed src="jam.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="184" height="51"></embed>
					  </object></div>
					</div>
					<div class="right_bg_bot"></div>
				</div>
			</div>
		<!--end of kotak informasi-->
		
		<div id="footer">
			<p>Copyright &copy; 2012 TBS Pharmacy. All Rights Reserved - Created by ANDHIKA BAYU PAKARTI</p>
		</div>
		
    </body>
</html>
