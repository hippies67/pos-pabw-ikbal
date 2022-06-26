<?php
// mengaktifkan session
session_start();
// menghapus semua session
session_destroy();
// mengalihkan halaman sambil mengirim pesan logout\\
session_start();
$_SESSION['success'] = 'Logout telah berhasil dilakukan';
header("location:login.php");
?>