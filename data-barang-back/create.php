<?php
	session_start();
	include_once('../connection.php');

	if(isset($_POST['create'])){
        
		$id_barang = $_POST['id_barang'];
        $id_kategori = $_POST['id_kategori'];
        $nama_barang = $_POST['nama_barang'];
        $merk = $_POST['merk'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $satuan_barang = $_POST['satuan_barang'];
        $stok = $_POST['stok'];
        $tgl_input = date("j F Y, G:i");

		$sql = "INSERT INTO barang (id_barang, id_kategori, nama_barang, merk, harga_beli, harga_jual, satuan_barang, stok, tgl_input) VALUES ('$id_barang', '$id_kategori', '$nama_barang', '$merk', '$harga_beli', '$harga_jual', '$satuan_barang', '$stok', '$tgl_input')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success-add'] = 'Data telah berhasil ditambahkan';
		}
		
		
		else{
			$_SESSION['error-add'] = 'Error! Data gagal untuk di tambahkan';
		}
	}
	else{
		$_SESSION['error-add'] = 'Isi formulir terlebih dulu!';
	}

	header('location: ../data-barang.php');
?>