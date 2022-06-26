<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-".date('Y-m-d').".xls");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 

    require 'config.php';
    include $view;
    $lihat = new view($config);

    $bulan_tes =array(
        '01'=>"Januari",
        '02'=>"Februari",
        '03'=>"Maret",
        '04'=>"April",
        '05'=>"Mei",
        '06'=>"Juni",
        '07'=>"Juli",
        '08'=>"Agustus",
        '09'=>"September",
        '10'=>"Oktober",
        '11'=>"November",
        '12'=>"Desember"
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<!-- view barang -->	
    <!-- view barang -->	
    <div class="modal-view">
        <h3 style="text-align:center;"> 
                <?php if(!empty($_GET['cari'])){ ?>
                    Data Laporan Penjualan <?= $bulan_tes[$_GET['bln']];?> <?= $_GET['thn'];?>
                <?php }elseif(!empty($_GET['hari'])){?>
                    Data Laporan Penjualan <?= $_GET['tgl'];?>
                <?php }else{?>
                    Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
                <?php }?>
        </h3>
     
    </div>
</body>
</html>