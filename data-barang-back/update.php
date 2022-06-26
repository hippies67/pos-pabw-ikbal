<?php
	session_start();
	include_once('../connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['edit_id'];

		$id_barang = $_POST['edit_id_barang'];
        $id_kategori = $_POST['edit_id_kategori'];
        $nama_barang = $_POST['edit_nama_barang'];
        $merk = $_POST['edit_merk'];
        $harga_beli = $_POST['edit_harga_beli'];
        $harga_jual = $_POST['edit_harga_jual'];
        $satuan_barang = $_POST['edit_satuan_barang'];
        $stok = $_POST['edit_stok'];
        $tgl_input = $_POST['edit_tgl_input'];
        $tgl_update = date("j F Y, G:i");

		$sql = "UPDATE barang SET id_barang = '$id_barang', id_kategori = '$id_kategori', nama_barang = '$nama_barang', merk = '$merk', harga_beli = '$harga_beli', harga_jual = '$harga_jual', satuan_barang = '$satuan_barang', stok = '$stok', tgl_input = '$tgl_input', tgl_update = '$tgl_update' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success-edit'] = 'Data telah berhasil di ubah';
		}
		
		else{
			$_SESSION['error-edit'] = 'Error! Data gagal untuk di ubah';
		}
	}
	else{
		$_SESSION['error-edit'] = 'Pilih data yang akan di ubah terlebih dahulu';
	}

	header('location: ../data-barang.php');

?>