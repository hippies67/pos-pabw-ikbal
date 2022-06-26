<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "UPDATE admin SET username = '$username', password = '$password' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data telah berhasil di ubah';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member updated successfully';
		// }
		///////////////
		
		else{
			$_SESSION['error'] = 'Error! Data gagal untuk di ubah';
		}
	}
	else{
		$_SESSION['error'] = 'Pilih data yang akan di ubah terlebih dahulu';
	}

	header('location: admin.php');

?>