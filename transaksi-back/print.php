<?php 
	require '../connection.php';
?>
<html>
	<head>
        <title>KASIR</title>
		<link rel="apple-touch-icon" sizes="180x180" href="../app-assets/logo.PNG">
		<link rel="icon" type="image/png" sizes="32x32" href="../app-assets/logo.PNG">
		<link rel="icon" type="image/png" sizes="16x16" href="../app-assets/logo.PNG">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>
	<body>
        <script>window.print();</script>
		<div class="container">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
						<!-- <p><?php echo $toko['nama_toko'];?></p>
						<p><?php echo $toko['alamat_toko'];?></p> -->
						<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
						<p>Kasir : <?php  echo $_POST['nm_member'];?></p>
					</center>
					<table class="table table-bordered" style="width:100%;">
						<tr>
							<td>No.</td>
							<td>Barang</td>
							<td>Jumlah</td>
							<td>Total</td>
						</tr>
                        <?php 
                            $total_bayar=0; 
                            $no=1; 
                                                            
                            $hasil_penjualan = "SELECT penjualan.* , barang.id_barang, barang.nama_barang from penjualan left join barang on barang.id_barang=penjualan.id_barang ORDER BY id_penjualan";
                            $query = $conn->query($hasil_penjualan);
                        ?>
						<?php $no=1; foreach($query as $isi){?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $isi['nama_barang'];?></td>
							<td><?php echo $isi['jumlah'];?></td>
							<td><?php echo $isi['total'];?></td>
						</tr>
						<?php $no++; }?>
					</table>
					<div class="mt-4">
                        <?php 
                            $sql ="SELECT SUM(total) as bayar FROM penjualan";
                            $sum = mysqli_fetch_assoc($conn->query($sql));
                        ?>
						Total : Rp.<?php echo number_format($sum['bayar']);?>,-
						<br/>
						Bayar : Rp.<?php echo number_format($_POST['bayar']);?>,-
						<br/>
						Kembali : Rp.<?php echo number_format($_POST['kembali']);?>,-
					</div>
					<div class="clearfix"></div>
					<center class="mt-4">
						<p>Terima Kasih Telah berbelanja di toko kami !</p>
					</center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
       
	</body>
</html>
