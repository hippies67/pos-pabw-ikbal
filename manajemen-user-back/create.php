<?php
	session_start();
	include_once('../connection.php');

	if(isset($_POST['create'])){
		$nama = $_POST['nama'];
        $username = $_POST['username'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		$sql = "INSERT INTO user (nama, username, password) VALUES ('$nama', '$username', '$password')";

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

	header('location: ../manajemen-user.php');
?>