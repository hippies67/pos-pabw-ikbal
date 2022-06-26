<?php
	session_start();
	include_once('connection.php');

		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = mysqli_query($conn,"select * from user where username='$username' and password='$password'");

		$cek = mysqli_num_rows($sql);

		if($cek > 0) {
			$_SESSION['success'] = 'Hallo '. '<b>' .$username . '</b>' .' Selamat anda telah berhasil melakukan login';
            $_SESSION['auth_username'] = $username;
            header("location:dashboard.php");
		}else{
			$_SESSION['error'] = 'Error! Username Atau Password Salah';
            header("location:login.php");
		}
?>
