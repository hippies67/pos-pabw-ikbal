<?php
    $title_menu = "Data User";

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
                <li class="breadcrumb-item active"><a href="indikator_pokok">Transaksi</a>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Keranjang Penjualan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 main-chart">
                                <div class="col-sm-12">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <h4><i class="fa fa-search"></i> Cari Barang</h4>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" id="cari" class="form-control" name="cari" 
                                                placeholder="Masukan : Kode / Nama Barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 id="result_title" style="display: none;"><i class="fa fa-list"></i> Hasil Pencarian</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div id="hasil_cari"></div>
                                            <div id="tunggu"></div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 mt-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4><i class="fa fa-shopping-cart mr-1"></i> KASIR</h4>
                                            <form method="POST" action="transaksi-back/delete.php"
                                                style="display:inline;" id="resetTransaksiForm">
                                                <input type="hidden" name="reset" value="yes">
                                                <button type="button" class="btn btn-sm btn-danger pull-right"
                                                    style="margin-top:-0.5pc;" onclick="resetData(this)">
                                                    <b>RESET KERANJANG</b>
                                                </button>
                                            </form>

                                        </div>
                                        <div class="card-body">
                                            <div id="keranjang">
                                                <table class="table table-bordered mt-4">
                                                    <tr>
                                                        <td><b>Tanggal</b></td>
                                                        <td><input type="text" readonly="readonly" class="form-control"
                                                                value="<?php echo date("j F Y, G:i");?>" name="tgl">
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table table-bordered" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <td> No</td>
                                                            <td> Nama Barang</td>
                                                            <td style="width:10%;"> Jumlah</td>
                                                            <td style="width:20%;"> Total</td>
                                                            <td> Aksi</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $total_bayar=0; 
                                                            $no=1; 
                                                            
                                                            $hasil_penjualan = "SELECT penjualan.* , barang.id_barang, barang.nama_barang from penjualan left join barang on barang.id_barang=penjualan.id_barang ORDER BY id_penjualan";
                                                            $query = $conn->query($hasil_penjualan);
                                                        ?>

                                                        <?php foreach($query as $isi){;?>
                                                        <tr>
                                                            <td><?php echo $no;?></td>
                                                            <td><?php echo $isi['nama_barang'];?></td>
                                                            <td>
                                                                <form method="POST" action="transaksi-back/update.php"
                                                                    style="display:inline;" id="ubahTransaksiForm">
                                                                    <input type="hidden" name="jual" value="jual">
                                                                    <input type="number" name="jumlah"
                                                                        value="<?php echo $isi['jumlah'];?>"
                                                                        class="form-control">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $isi['id_penjualan'];?>"
                                                                        class="form-control">
                                                                    <input type="hidden" name="id_barang"
                                                                        value="<?php echo $isi['id_barang'];?>"
                                                                        class="form-control">
                                                            </td>
                                                            <td>Rp.<?php echo number_format($isi['total']);?>,-</td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-warning"
                                                                    onclick="updateData(this)"><i
                                                                        class="fas fa-edit mr-1"></i> Ubah</button>
                                                                </form>
                                                                <!-- aksi ke table penjualan -->
                                                                <form method="POST" action="transaksi-back/delete.php"
                                                                    style="display:inline;" id="hapusTransaksiForm">

                                                                    <input type="hidden" name="id_penjualan"
                                                                        value="<?php echo $isi['id_penjualan'];?>">
                                                                    <input type="hidden" name="id_barang"
                                                                        value="<?php echo $isi['id_barang'];?>">
                                                                    <input type="hidden" name="jumlah"
                                                                        value="<?php echo $isi['jumlah']; ?>">

                                                                    <button type="button" class="btn btn-sm btn-danger"
                                                                        onclick="deleteData(this)"><i
                                                                            class="fa fa-times mr-1"></i> Hapus</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php $no++; $total_bayar += $isi['total'];}?>
                                                    </tbody>
                                                </table>
                                                <br />
                                                <div id="kasirnya">
                                                    <table class="table table-stripped">
                                                        <!-- aksi ke table nota -->
                                                        <form method="POST" action="transaksi-back/bayar.php">
                                                            <input type="hidden" name="nota" value="yes">
                                                            <?php foreach($query as $isi){;?>
                                                            <input type="hidden" name="id_barang[]"
                                                                value="<?php echo $isi['id_barang'];?>">
                                                            <input type="hidden" name="jumlah[]"
                                                                value="<?php echo $isi['jumlah'];?>">
                                                            <input type="hidden" name="total1[]"
                                                                value="<?php echo $isi['total'];?>">
                                                            <input type="hidden" name="tgl_input[]"
                                                                value="<?php echo $isi['tanggal_input'];?>">
                                                            <input type="hidden" name="periode[]"
                                                                value="<?php echo date('m-Y');?>">
                                                            <?php $no++; }?>
                                                            <tr>
                                                                <td>Total Semua </td>
                                                                <td><input type="text" class="form-control" name="total"
                                                                        value="<?php echo isset($total_bayar) ? $total_bayar : ''; ?>">
                                                                </td>
                                                                <td>Bayar </td>
                                                                <td><input type="text" class="form-control" name="bayar"
                                                                        value="<?php echo isset($_SESSION['bayar']) ? $_SESSION['bayar'] : ''; ?>">
                                                                </td>
                                                                <td>
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success"><i
                                                                            class="fa fa-shopping-cart mr-1"></i>
                                                                        Bayar
                                                                    </button>
                                                                    <?php  if(!empty($_SESSION['nota'])) {?>
                                                                    <form action="transaksi-back/delete.php" method="post" style="display: inline;">
                                                                        <input type="hidden" name="reset" value="yes">
                                                                        <button type="button" class="btn btn-sm btn-danger" onclick="resetData(this)">
                                                                            <b>RESET</b>
                                                                        </button>
                                                                    </form>
                                                                    
                                                                </td><?php }?></td>
                                                            </tr>
                                                        </form>
                                                        <!-- aksi ke table nota -->
                                                        <tr>
                                                            <td>Kembali</td>
                                                            <td><input type="text" class="form-control"
                                                                    value="<?php echo isset($_SESSION['hitung']) ? $_SESSION['hitung'] : ''; ?>">
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                <form action="transaksi-back/print.php" method="post">
                                                                    <input type="hidden" name="nm_member" value="admin">
                                                                    <input type="hidden" name="bayar" value="<?php echo isset($_SESSION['bayar']) ? $_SESSION['bayar'] : ''; ?>">
                                                                    <input type="hidden" name="kembali" value="<?php echo isset($_SESSION['hitung']) ? $_SESSION['hitung'] : ''; ?>">
                                                                    <button class="btn btn-sm btn-default" target="_blank">
                                                                        <i class="fa fa-print"></i> Print Untuk Bukti
                                                                        Pembayaran
                                                                    </button></a>
                                                                </form>
                                                            </td>

                                                        </tr>
                                                    </table>
                                                    <br />
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="app-assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $("#cari").keyup(function() {
            $.ajax({
                type: "POST",
                url: "transaksi-back/update.php",
                data: {
                    keyword: $(this).val()
                },
                beforeSend: function() {
                    $("#hasil_cari").hide();
                    $("#tunggu").html(
                        '<p style="color:green"><blink>tunggu sebentar</blink></p>');
                },
                success: function(html) {
                    if(html != '') {
                        $("#result_title").css('display', 'block');
                        $("#tunggu").html('');
                        $("#hasil_cari").show();
                        $("#hasil_cari").html(html);
                    } else {
                        $("#result_title").css('display', 'none');
                        $("#tunggu").css('display', 'none');
                    }
                }
            });
        });
    });

    function updateData(e) {
        Swal.fire({
            title: "Ubah data penjualan?",
            text: `Data penjualan akan diubah. Anda tidak akan dapat mengembalikan
                aksi ini!`,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "rgb(11, 42, 151)",
            cancelButtonColor: "rgb(209, 207, 207)",
            confirmButtonText: "Ya, ubah!",
            cancelButtonText: "Batal"
        }).then(function(t) {
            if (t.value) {
                $("#ubahTransaksiForm").submit();
            }
        })
    }

    function resetData(e) {
        Swal.fire({
            title: "Reset data penjualan?",
            text: `Data penjualan akan ter-reset. Anda tidak akan dapat mengembalikan
                aksi ini!`,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "rgb(11, 42, 151)",
            cancelButtonColor: "rgb(209, 207, 207)",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then(function(t) {
            if (t.value) {
                $("#resetTransaksiForm").submit();
            }
        })
    }

    function deleteData(e) {
        Swal.fire({
            title: "Hapus data penjualan?",
            text: `Data penjualan akan terhapus. Anda tidak akan dapat mengembalikan
                aksi ini!`,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "rgb(11, 42, 151)",
            cancelButtonColor: "rgb(209, 207, 207)",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then(function(t) {
            if (t.value) {
                $("#hapusTransaksiForm").submit();
            }
        })
    }

    // TAMBAH DATA CONTROLLER SWETALERT
    </script>
    <?php
    include('layouts/bottom.php');
?>