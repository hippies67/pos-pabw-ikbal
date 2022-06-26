<?php
	session_start();
	include_once('../connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['edit_id_user'];
		$get_db = "SELECT * FROM user WHERE id = '$id'";
		$data_db = $conn->query($get_db);

		if($_POST['edit_password']) {
			$password = password_hash($_POST['edit_password'], PASSWORD_DEFAULT);
		} else {
			while ($row = $data_db->fetch_assoc()) {
				$password = $row['password'];
			}
		}
		
		$nama = $_POST['edit_nama'];
        $username = $_POST['edit_username'];

		$sql = "UPDATE user SET nama = '$nama', username = '$username', password = '$password' WHERE id = '$id'";

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

	header('location: ../manajemen-user.php');

?>