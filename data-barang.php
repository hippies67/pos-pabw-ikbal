<?php
    $title_menu = "Data Barang";

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
                <li class="breadcrumb-item active"><a href="indikator_pokok">Barang</a>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Barang</h4>
                        <div class="button-list">
                            <button type="button" data-toggle="modal" data-target="#addBarang"
                                class="btn btn-primary btn-xs" data-animation="slide" data-plugin="custommodal"
                                data-overlaySpeed="200" data-overlayColor="#36404a"><i
                                    class="fa fa-plus-circle mr-1"></i> Tambah</button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataBarangTable" class="display text-dark" width="100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Barang</th>
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Merk</th>
                                        <th>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       
                                        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
                                        from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
                                        ORDER BY id DESC";
                                        $query = $conn->query($sql);
                               
                                        $number = 1;
                                    ?>
                                    <?php while($data = $query->fetch_assoc()) :  ?>
                                    <tr>
                                        <td style="color: #000000;"><?= $number++ ?></td>
                                        <td style="color: #000000;"><?php echo $data['id_barang'];?></td>
                                        <td style="color: #000000;"><?php echo $data['nama_kategori'];?></td>
                                        <td style="color: #000000;"><?php echo $data['nama_barang'];?></td>
                                        <td style="color: #000000;"><?php echo $data['merk'];?></td>
                                        <td style="color: #000000;">
                                            <?php if($data['stok'] == '0'){?>
                                            <button class="btn btn-danger"> Habis</button>
                                            <?php }else{?>
                                            <?php echo $data['stok'];?>
                                            <?php }?>
                                        </td>
                                        <td style="color: #000000;">
                                            Rp.<?php echo number_format($data['harga_beli']);?>,-</td>
                                        <td style="color: #000000;">
                                            Rp.<?php echo number_format($data['harga_jual']);?>,-</td>
                                        <td style="color: #000000;"> <?php echo $data['satuan_barang'];?></td>
                                        <td>
                                            <div class="button-list">
                                                <button type="button" data-toggle="modal"
                                                    data-target="#editBarang"
                                                    onclick="editData('<?=$data['id']?>', '<?=$data['id_barang']?>', '<?=$data['id_kategori']?>', '<?=$data['nama_barang']?>', '<?=$data['merk']?>', '<?=$data['harga_beli']?>', '<?=$data['harga_jual']?>', '<?=$data['satuan_barang']?>', '<?=$data['stok']?>', '<?=$data['tgl_input']?>')"
                                                    class="btn btn-warning btn-xs text-white"><i
                                                        class="fa fa-edit mr-1"></i>Edit</button>
                                                <form style="display: inline"
                                                    action="data-barang-back/delete.php"
                                                    method="post">

                                                    <input type="hidden" name="id_delete" value="<?=$data['id']?>">

                                                    <button type="button" onclick="deleteData(this)"
                                                        class="btn btn-xs btn-danger" id="deleteButton"><i
                                                            class="fa fa-trash mr-1"></i> Hapus</button>
                                                </form>
                                                <!-- <button type="button" data-toggle="modal"
                                                    data-target="#detailBarang"
                                                    onclick="detailData('<?=$data['id']?>', '<?=$data['id_barang']?>', '<?=$data['id_kategori']?>', '<?=$data['nama_barang']?>', '<?=$data['merk']?>', '<?=$data['harga_beli']?>', '<?=$data['harga_jual']?>', '<?=$data['satuan_barang']?>', '<?=$data['stok']?>', '<?=$data['tgl_input']?>')"
                                                    class="btn btn-xs btn-info" id="detailButton"><i
                                                        class="fas fa-info-circle mr-1"></i> Detail</button> -->
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="addBarang">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="data-barang-back/create.php" method="post" id="addBarangForm"
                            enctype="multipart/form-data">

                            <input type="hidden" name="create" value="create_data">

                            <div class="form-group">
                                <?php
                                    $sql = 'SELECT * FROM barang ORDER BY id DESC';
                                    $query = $conn->query($sql);
                                ?>
                                    <?php while($data = $query->fetch_assoc()) {
                                        $urut = substr($data['id_barang'], 2, 3);
                                        $tambah = (int) $urut + 1;
                                        if(strlen($tambah) == 1){
                                            $format = 'BR00'.$tambah.'';
                                        }else if(strlen($tambah) == 2){
                                            $format = 'BR0'.$tambah.'';
                                        }else{
                                            $ex = explode('BR',$data['id_barang']);
                                            $no = (int) $ex[1] + 1;
                                            $format = 'BR'.$no.'';
                                        }
                                        
                                    } 
                                    ?>
                                <label for="nama_indikator">Kode Barang</label>
                                <input type="text" name="id_barang" value="<?= $format; ?>" class="form-control" readonly="readonly">
                            </div>

                            <div class="form-group">
                                <label for="nama_indikator">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang"
                                    placeholder="Masukan Nama Barang">
                            </div>

                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <?php
                                        $sql = "select * from kategori";
                                        $query = $conn->query($sql);
                                    ?>
                                    <?php while($data = $query->fetch_assoc()) :  ?>
                                        <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control money" name="merk" id="merk"
                                    placeholder="Masukan Merk"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>

                            <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="text" class="form-control money" name="harga_beli" id="harga_beli"
                                    placeholder="Masukan Harga Beli"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>

                            <div class="form-group">
                                <label for="harga_beli">Harga Jual</label>
                                <input type="text" class="form-control money" name="harga_jual" id="harga_jual"
                                    placeholder="Masukan Harga Jual"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>

                            <div class="form-group">
                                <label for="satuan_barang">Satuan Barang</label>
                                <select name="satuan_barang" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    <option value="PCS">PCS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control money" name="stok" id="stok"
                                    placeholder="Masukan Stok"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="tambahBarangButton">Simpan
                            Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editBarang">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="data-barang-back/update.php" method="post" id="editBarangForm"
                            enctype="multipart/form-data">

                            <input type="hidden" name="edit" value="edit_data">
                            <input type="hidden" name="edit_id">
                            <input type="hidden" name="edit_tgl_input">

                            <div class="form-group">
                                <label for="nama_indikator">Kode Barang</label>
                                <input type="text" readonly="readonly" required class="form-control" name="edit_id_barang" id="edit_id_barang">
                            </div>

                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select name="edit_id_kategori" class="form-control" id="edit_id_kategori">
                                    <?php
                                        $sql = "select * from kategori";
                                        $query = $conn->query($sql);
                                    ?>
                                    <?php while($data = $query->fetch_assoc()) :  ?>
                                        <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama_indikator">Nama Barang</label>
                                <input type="text" class="form-control" name="edit_nama_barang" id="edit_nama_barang"
                                    placeholder="Masukan Nama Barang">
                            </div>

                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control money" name="edit_merk" id="edit_merk"
                                    placeholder="Masukan Merk"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>

                            <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="text" class="form-control money" name="edit_harga_beli" id="edit_harga_beli"
                                    placeholder="Masukan Harga Beli"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>

                            <div class="form-group">
                                <label for="harga_beli">Harga Jual</label>
                                <input type="text" class="form-control money" name="edit_harga_jual" id="edit_harga_jual"
                                    placeholder="Masukan Harga Jual"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>

                            <div class="form-group">
                                <label for="edit_satuan_barang">Satuan Barang</label>
                                <select name="edit_satuan_barang" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    <option value="PCS">PCS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control money" name="edit_stok" id="edit_stok"
                                    placeholder="Masukan Stok"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="editBarangButton">Simpan
                            Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailBarang">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Indikator Pokok</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h6>Nama Indikator</h6>
                                    <p style="font-size: 14px;" id="detailNamaIndikator"></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h6>Target</h6>
                                    <p style="font-size: 14px;" id="detailTarget"></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h6>Realisasi</h6>
                                    <p style="font-size: 14px;" id="detailRealisasi"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h6>Analisis</h6>
                                    <p style="font-size: 14px;" id="detailAnalisis"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="app-assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#dataBarangTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excel', 
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
        }]
    });
});

function detailData(dataId, namaIndikator, dataTarget, dataRealisasi, dataAnalisis) {
    $('#detailNamaIndikator').text(namaIndikator);
    $('#detailTarget').text(dataTarget);
    $('#detailRealisasi').text(dataRealisasi);
    $('#detailAnalisis').text(dataAnalisis);
}

// const updateLink = $('#editBarangForm').attr('action');
const idForm = $('#editBarangForm').attr('id');

function editData(dataId, id_barang, id_kategori, nama_barang, merk, harga_beli, harga_jual, satuan_barang, stok, tgl_input) {

    // make form id unique for jquery validaiton
    $('#editBarangForm').attr('id', `${idForm}${dataId}`);
    // $('#editBarangForm' + dataId).attr('action', `${updateLink}/${dataId}`);
    $('[name="edit_id"]').val(dataId);
    $('[name="edit_id_barang"]').val(id_barang);
    $('[name="edit_id_kategori"]').val(id_kategori);
    $('[name="edit_nama_barang"]').val(nama_barang);
    $('[name="edit_merk"]').val(merk);
    $('[name="edit_harga_beli"]').val(harga_beli);
    $('[name="edit_harga_jual"]').val(harga_jual);
    $('[name="edit_satuan_barang"]').val(satuan_barang);
    $('[name="edit_stok"]').val(stok);
    $('[name="edit_tgl_input"]').val(tgl_input);


    validateFormEdit(dataId);
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$("#addBarangForm").validate({
    rules: {
        id_barang: {
            required: true,
        },
        id_kategori: {
            required: true,
        },
        nama_barang: {
            required: true,
        },
        merk: {
            required: true,
        },
        harga_beli: {
            required: true,
        },
        harga_jual: {
            required: true,
        },
        satuan_barang: {
            required: true,
        },
        stok: {
            required: true,
        },
    },
    messages: {
        id_barang: {
            required: "ID Barang harus di isi.",
        },
        id_kategori: {
            required: "Kategori harus di isi.",
        },
        nama_barang: {
            required: "Nama Barang harus di isi.",
        },
        merk: {
            required: "Merk harus di isi.",
        },
        harga_beli: {
            required: "Harga Beli harus di isi.",
        },
        harga_jual: {
            required: "Harga Jual harus di isi.",
        },
        satuan_barang: {
            required: "Satuan Barang harus di isi.",
        },
        stok: {
            required: "Stok harus di isi.",
        }
    },
    submitHandler: function(form) {
        $("#tambahBarangButton").prop('disabled', true);
        form.submit();
    }
});

function validateFormEdit(dataId) {
    $("#editBarangForm" + dataId).validate({
        rules: {
            edit_id_barang: {
                required: true,
            },
            edit_id_kategori: {
                required: true,
            },
            edit_nama_barang: {
                required: true,
            },
            edit_merk: {
                required: true,
            },
            edit_harga_beli: {
                required: true,
            },
            edit_harga_jual: {
                required: true,
            },
            edit_satuan_barang: {
                required: true,
            },
            edit_stok: {
                required: true,
            },
        },
        messages: {
            edit_id_barang: {
                required: "ID Barang harus di isi.",
            },
            edit_id_kategori: {
                required: "Kategori harus di isi.",
            },
            edit_nama_barang: {
                required: "Nama Barang harus di isi.",
            },
            edit_merk: {
                required: "Merk harus di isi.",
            },
            edit_harga_beli: {
                required: "Harga Beli harus di isi.",
            },
            edit_harga_jual: {
                required: "Harga Jual harus di isi.",
            },
            edit_satuan_barang: {
                required: "Satuan Barang harus di isi.",
            },
            edit_stok: {
                required: "Stok harus di isi.",
            }
        },
        submitHandler: function(form) {
            $("#editBarangButton").prop('disabled', true);
            form.submit();
        }
    });
}


function deleteData(e) {
    Swal.fire({
        title: "Hapus data barang?",
        text: `Data barang akan terhapus. Anda tidak akan dapat mengembalikan
                aksi ini!`,
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "rgb(11, 42, 151)",
        cancelButtonColor: "rgb(209, 207, 207)",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then(function(t) {
        if (t.value) {
            e.parentNode.submit()
        }
    })
}

// TAMBAH DATA CONTROLLER SWETALERT

<?php if(isset($_SESSION['success-add'])) :?>
            Swal.fire({
                title: "Berhasil!",
                text: `Data user telah berhasil ditambahkan!`,
                type: "success",
            });
        <?php endif ?>

        <?php 
            unset($_SESSION['success-add']);
        ?>

        <?php if(isset($_SESSION['error-add'])) :?>
            Swal.fire({
                title: "Error!",
                text: `Data user gagal untuk ditambahkan!`,
                type: "error",
            });
        <?php endif ?>

        <?php 
            unset($_SESSION['error-add']);
        ?>

    <?php if(isset($_SESSION['success-edit'])) :?>
            Swal.fire({
                title: "Berhasil!",
                text: `Data user telah berhasil ditambahkan!`,
                type: "success",
            });
        <?php endif ?>

        <?php 
            unset($_SESSION['success-edit']);
        ?>

        <?php if(isset($_SESSION['error-edit'])) :?>
            Swal.fire({
                title: "Error!",
                text: `Data user gagal untuk ditambahkan!`,
                type: "error",
            });
        <?php endif ?>

        <?php 
            unset($_SESSION['error-edit']);
        ?>

    <?php if(isset($_SESSION['success-hapus'])) :?>
            Swal.fire({
                title: "Berhasil!",
                text: `Data user telah berhasil ditambahkan!`,
                type: "success",
            });
        <?php endif ?>

        <?php 
            unset($_SESSION['success-hapus']);
        ?>

        <?php if(isset($_SESSION['error-hapus'])) :?>
            Swal.fire({
                title: "Error!",
                text: `Data user gagal untuk ditambahkan!`,
                type: "error",
            });
        <?php endif ?>

        <?php 
            unset($_SESSION['error-hapus']);
        ?>
</script>
<?php
    include('layouts/bottom.php');
?>