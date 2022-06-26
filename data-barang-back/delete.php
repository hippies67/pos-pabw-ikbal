<?php
	session_start();
	include_once('../connection.php');

	if(isset($_POST['id_delete'])){
		$sql = "DELETE FROM barang WHERE id = '".$_POST['id_delete']."'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success-hapus'] = 'Data telah berhasil dihapus';
		}
		
		else{
			$_SESSION['error-hapus'] = 'Error! Data gagal untuk di hapus';
		}
	}
	else{
		$_SESSION['error-hapus'] = 'Pilih data yang akan dihapus terlebih dahulu';
	}

	header('location: ../data-barang.php');
?>