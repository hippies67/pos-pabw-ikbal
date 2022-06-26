<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data telah berhasil ditambahkan';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member added successfully';
		// }
		//////////////
		
		else{
			$_SESSION['error'] = 'Error! Data gagal untuk di tambahkan';
		}
	}
	else{
		$_SESSION['error'] = 'Isi formulir terlebih dulu!';
	}

	header('location: admin.php');
?>