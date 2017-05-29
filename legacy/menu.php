<?php
$page=@$_GET['page'];
switch($page){
	case "awal" : include "awal.php"; break;
	
	case "pbf_view" : include "pbf/pbf_view.php";break;
	case "pbf_insert" : include "pbf/pbf_insert.php";break;
	case "pbf_insert_action" : include "pbf/pbf_insert_action.php";break;
	case "pbf_update_action" : include "pbf/pbf_update_action.php";break;
	case "pbf_update" : include "pbf/pbf_update.php";break;
	case "pbf_search" : include "pbf/pbf_search.php";break;
	
	case "obat_view" : include "obat/obat_view.php"; break;
	case "obat_update" : include "obat/obat_update.php"; break;
	case "obat_search" : include "obat/obat_search.php"; break;
	case "obat_insert" : include "obat/obat_insert.php"; break;
	case "obat_insert_action" : include "obat/obat_insert_action.php"; break;
	case "obat_update_action" : include "obat/obat_update_action.php"; break;
	
	case "stok_view" : include "stok/stok_view.php"; break;
	//case "stok_search" : include "stok/stok_search.php"; break;
	case "expired" : include "stok/expired.php"; break;
	case "kartu_stok" : include "stok/kartu_stok.php"; break;
	case "kartu_stok_keluar" : include "stok/kartu_stok_keluar.php"; break;
	case "stok_view_etalase" : include "stok/stok_view_etalase.php"; break;
	case "stok_minimum" : include "stok/stok_minimum.php"; break;
	//case "stok_search_etalase" : include "stok/stok_search_etalase.php"; break;
	
	case "karyawan_view" : include "karyawan/karyawan_view.php"; break;
	case "karyawan_insert" : include "karyawan/karyawan_insert.php"; break;
	case "karyawan_insert_action" : include "karyawan/karyawan_insert_action.php"; break;
	case "karyawan_search" : include "karyawan/karyawan_search.php"; break;
	case "karyawan_update" : include "karyawan/karyawan_update.php"; break;
	case "karyawan_update_action" : include "karyawan/karyawan_update_action.php"; break;
	
	case "laporan" : include "laporan/laporan.php"; break;
	case "laporan_action" : include "laporan/laporan_action.php"; break;
	case "laporan_penjualan_periode" : include "laporan/laporan_penjualan_periode.php"; break;
	
	case "pemesanan_view" : include "pemesanan/pemesanan_view.php"; break;
	case "pemesanan_insert" : include "pemesanan/pemesanan_insert.php"; break;

	case "penjualan_insert" : include "penjualan/penjualan_insert.php"; break;
	case "penjualan_form" : include "penjualan/penjualan_form.php"; break;
	case "print_struk" : include "penjualan/print_struk.php"; break;
	//case "cek_harga" : include "penjualan/cek_harga.php"; break;
	case "penjualan_update" : include "penjualan/penjualan_update.php"; break;
	case "penjualan_update_form" : include "penjualan/penjualan_update_form.php"; break;
	case "penjualan_update_form_action" : include "penjualan/penjualan_update_form_action.php"; break;
	case "penjualan_insert_dokter" : include "penjualan/penjualan_insert_dokter.php"; break;
	case "penjualan_insert_langganan" : include "penjualan/penjualan_insert_langganan.php"; break;
	case "tampilan_akhir" : include "penjualan/tampilan_akhir.php"; break;
	case "penjualan_faktur" : include "penjualan/penjualan_faktur.php"; break;
	
	case "faktur_insert" : include "faktur/faktur_insert.php"; break;
	case "faktur_histori" : include "faktur/faktur_histori.php"; break;
	
	case "pembelian_insert" : include "pembelian/pembelian_insert.php"; break;
	case "laporan_pengiriman" : include "pembelian/laporan_pengiriman.php"; break;
	
	case "pembayaran_insert" : include "pembayaran/pembayaran_insert.php"; break;
	
	case "mutasi" : include "mutasi/mutasi.php"; break;
	case "mutasi_form" : include "mutasi/mutasi_form.php"; break;
	case "cek_produk" : include "mutasi/cek_produk.php"; break;
	
	case "retur" : include "retur/retur.php"; break;
	case "retur_cari" : include "retur/retur_cari.php"; break;

	case "login" : include "login/login.php"; break;
	case "logout" : include "login/logout.php"; break;
	case "logincek" : include "login/logincek.php"; break;
	
	case "resep" : include "resep/resep.php"; break;
	case "tampil_resep" : include "resep/tampil_resep.php"; break;
	case "cari_resep" : include "resep/cari_resep.php"; break;
	case "resep_update" : include "resep/resep_update.php"; break;
	
	default : include "awal.php";break;
}

?>