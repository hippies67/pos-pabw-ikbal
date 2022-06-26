<?php
	session_start();
	include_once('../connection.php');

	if(isset($_POST['id_penjualan'])){
		$sql = "DELETE FROM penjualan WHERE id_penjualan = '".$_POST['id_penjualan']."'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data telah berhasil dihapus';
		}
		
		else{
			$_SESSION['error'] = 'Error! Data gagal untuk di hapus';
		}
	}
	else{
		$_SESSION['error'] = 'Pilih data yang akan dihapus terlebih dahulu';
	}

	if(isset($_POST['reset'])){
		$sql = 'DELETE FROM penjualan';

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['bayar'] = "";
		}
		
		else{
			$_SESSION['error'] = 'Error! Data gagal untuk di hapus';
		}
	}

	header('location: ../transaksi.php');
?>