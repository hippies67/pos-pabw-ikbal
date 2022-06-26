<?php
	session_start();
											if(!empty($_POST['nota'] == 'yes')) {
												$total = $_POST['total'];
												$bayar = $_POST['bayar'];
												if(!empty($bayar))
												{
													$hitung = $bayar - $total;
													if($bayar >= $total)
													{
														$id_barang = $_POST['id_barang'];
														$jumlah = $_POST['jumlah'];
														$total = $_POST['total1'];
														$tgl_input = $_POST['tgl_input'];
														$periode = $_POST['periode'];
														$jumlah_dipilih = count($id_barang);
														
														// for($x=0;$x<$jumlah_dipilih;$x++){

														// 	$d = array($id_barang[$x],$jumlah[$x],$total[$x],$tgl_input[$x],$periode[$x]);
														// 	$sql = "INSERT INTO nota (id_barang,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)";
														// 	$row = $config->prepare($sql);
														// 	$row->execute($d);

														// 	// ubah stok barang
														// 	$sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
														// 	$row_barang = $config->prepare($sql_barang);
														// 	$row_barang->execute(array($id_barang[$x]));
														// 	$hsl = $row_barang->fetch();
															
														// 	$stok = $hsl['stok'];
														// 	$idb  = $hsl['id_barang'];

														// 	$total_stok = $stok - $jumlah[$x];
														// 	// echo $total_stok;
														// 	$sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
														// 	$row_stok = $config->prepare($sql_stok);
														// 	$row_stok->execute(array($total_stok, $idb));
														// }
														$_SESSION['nota'] = $_POST['nota'];
														$_SESSION['total'] = $total;
														$_SESSION['bayar'] = $bayar;
														$_SESSION['hitung'] = $hitung;

														echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
														echo '<script>window.location="../transaksi.php"</script>';
														
													}else{

														$_SESSION['nota'] = $_POST['nota'];
														$_SESSION['total'] = $total;
														$_SESSION['bayar'] = $bayar;
														$_SESSION['hitung'] = "";

														echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
														echo '<script>window.location="../transaksi.php"</script>';
													}
												} else {
													echo '<script>window.location="../transaksi.php"</script>';
												}
											} else {
												echo '<script>window.location="../transaksi.php"</script>';
											}
											?>