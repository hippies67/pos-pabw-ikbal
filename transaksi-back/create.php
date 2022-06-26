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
			$_SESSION['success'] = 'Data telah berhasil ditambahkan';
			header('location: ../transaksi.php');
		}
		
		
		else{
			$_SESSION['error'] = 'Error! Data gagal untuk di tambahkan';
			header('location: ../transaksi.php');
		}
	}
	else{
		$_SESSION['error'] = 'Isi formulir terlebih dulu!';
	}

	if(isset($_POST['jual'])){
		$id = $_POST['id'];
		
	

		// get tabel barang id_barang 
		$sql = "SELECT * FROM barang WHERE id_barang = '$id'";
		$row = mysqli_fetch_assoc($conn->query($sql));
		
		if($row['stok'] > 0)
		{
			$jumlah = 1;
			$total = $row['harga_jual'];
			$tgl = date("j F Y, G:i");
			
			$sql = "INSERT INTO penjualan (id_barang, jumlah, total, tanggal_input) VALUES ('$id', '$jumlah', '$total', '$tgl')";
			

			if($conn->query($sql)){
				
				echo '<script>window.location="../transaksi.php"</script>';
			}

		} else {
			echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../transaksi.php"</script>';
		}
	}

?>