<?php
    $title_menu = "Dashboard";
    
	include('layouts/top.php');
    include('layouts/header.php');
    include('layouts/menu.php');
    include_once('connection.php');
?>

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="indikator_pokok">Dashboard</a>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xl-12 col-xxl-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card avtivity-card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="activity-icon bgl-success  mr-md-4 mr-3">
                                    <i class="fas fa-users" style="color: #27BC48;font-size: 25px;"></i>
                                    </span>
                                    <div class="media-body">
                                        <?php 
                                            $sql="select * from user";
                                            $total_akun = mysqli_num_rows($conn->query($sql));
                                        ?>
                                        <p class="fs-14 mb-2">Total Akun</p>
                                        <span class="title text-black font-w600"><?= $total_akun ?></span>
                                    </div>
                                </div>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-success" style="width: 100%; height:5px;"
                                        role="progressbar">
                                        <span class="sr-only">42% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="effect bg-success" style="top: 104px; left: -28px;"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card avtivity-card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="activity-icon bgl-secondary  mr-md-4 mr-3">
                                        <i class="fas fa-hdd" style="color: #A02CFA;font-size: 25px;"></i>
                                    </span>
                                    <div class="media-body">
                                        <?php 
                                         $sql=" select * from barang";
                                         $total_barang = mysqli_num_rows($conn->query($sql));
                                        ?>
                                        <p class="fs-14 mb-2">Total Barang</p>
                                        <span class="title text-black font-w600"><?= $total_barang ?></span>
                                    </div>
                                </div>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-secondary" style="width: 100%; height:5px;"
                                        role="progressbar">
                                        <span class="sr-only">42% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="effect bg-secondary" style="top: 104px; left: -28px;"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card avtivity-card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="activity-icon bgl-danger mr-md-4 mr-3">
                                        <i class="fas fa-layer-group" style="color: #FF3282;font-size: 25px;"></i>
                                    </span>
                                    <div class="media-body">
                                        <?php 
                                            $sql ="SELECT SUM(stok) as jml FROM barang";
                                            $jumlah = mysqli_fetch_assoc($conn->query($sql));
                                        ?>
                                        <p class="fs-14 mb-2">Stok Barang</p>
                                        <span class="title text-black font-w600"><?= $jumlah['jml'] ?></span>
                                    </div>
                                </div>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-danger" style="width: 100%; height:5px;"
                                        role="progressbar">
                                        <span class="sr-only">42% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="effect bg-danger" style="top: -15px; left: 275px;"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card avtivity-card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="activity-icon bgl-warning  mr-md-4 mr-3">
                                        <i class="fab fa-sellsy" style="color: #FFBC11;font-size: 25px;"></i>
                                    </span>
                                    <div class="media-body">
                                        <?php 
                                            $sql ="SELECT SUM(jumlah) as stok FROM nota";
                                            $terjual = mysqli_fetch_assoc($conn->query($sql));
                                        ?>
                                        <p class="fs-14 mb-2">Barang Terjual</p>
                                        <span class="title text-black font-w600"><?= $terjual['stok'] ?></span>
                                    </div>
                                </div>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-warning" style="width: 100%; height:5px;"
                                        role="progressbar">
                                        <span class="sr-only">42% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="effect bg-warning" style="top: 15px; left: -9px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
</div>

<?php
	include('layouts/footer.php');
?>
<script src="app-assets/vendor/global/global.min.js"></script>
<script src="app-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="app-assets/js/custom.min.js"></script>
<script src="app-assets/js/deznav-init.js"></script>
</script>
<?php
    include('layouts/bottom.php');
?>