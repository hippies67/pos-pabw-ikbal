<?php
	session_start();
	include_once('../connection.php');
	
	if(isset($_POST['jual'])){
		$id = $_POST['id'];
		$id_barang = $_POST['id_barang'];
		$jumlah = $_POST['jumlah'];
		
		$get_db = "select * from barang WHERE barang.id_barang = '$id_barang'";
		$row = mysqli_fetch_assoc($conn->query($get_db));

			if($row['stok'] > $jumlah) {
				$jual = $row['harga_jual'];
				$total = $jual * $jumlah;
				
				$sql = "UPDATE penjualan SET jumlah = '$jumlah', total = '$total' WHERE id_penjualan = '$id'";

				if($conn->query($sql)){
					echo '<script>window.location="../transaksi.php?page=jual#keranjang"</script>';
				}

			} else {
				echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
						window.location="../transaksi.php?page=jual#keranjang"</script>';
			}

	} else {
		$_SESSION['error'] = 'Pilih data yang akan di ubah terlebih dahulu';
	}

	if(isset($_POST['keyword'])) {

			$cari = trim(strip_tags($_POST['keyword']));
			if($cari == '')
			{
	
			}else{
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where barang.id_barang like '%$cari%' or barang.nama_barang like '%$cari%' or barang.merk like '%$cari%'";
				$query = $conn->query($sql);
		?>
			<div class="card">
				<div class="card-body">
					<table class="table table-stripped" width="100%" id="example2">
						<tr>
							<th>ID Barang</th>
							<th>Nama Barang</th>
							<th>Merk</th>
							<th>Harga Jual</th>
							<th>Aksi</th>
						</tr>
					<?php foreach($query as $hasil){?>
						<tr>
							<td><?php echo $hasil['id_barang'];?></td>
							<td><?php echo $hasil['nama_barang'];?></td>
							<td><?php echo $hasil['merk'];?></td>
							<td><?php echo $hasil['harga_jual'];?></td>
							<td>
								<form action="transaksi-back/create.php" method="post">
									<input type="hidden" name="jual" value="jual">
									<input type="hidden" name="id" value="<?= $hasil['id_barang']; ?>">

									<button type="submit" class="btn btn-sm btn-success">
										<i class="fa fa-shopping-cart"></i>
									</button>
								</form>
							</td>
						</tr>
					<?php }?>
					</table>
				</div>
			</div>
		<?php	
		}
	}

	// header('location: ../transaksi.php');

?>