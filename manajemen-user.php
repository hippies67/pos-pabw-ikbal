<?php
    $title_menu = "Data User";
    
	include('layouts/top.php');
    include('layouts/header.php');
    include('layouts/menu.php');
    include_once('connection.php');
?>

<style>
label.error {
    color: #F94687;
    font-size: 13px;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    margin-top: 5px;
    padding: 0;
}

input.error {
    color: #F94687;
    border: 1px solid #F94687;
}

select.error {
    color: #F94687;
    border: 1px solid #F94687;
}
</style>

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="indikator_pokok">Manajemen User</a>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data User</h4>
                        <div class="button-list">
                            <button type="button" data-toggle="modal" data-target="#addUser"
                                class="btn btn-primary btn-xs" data-animation="slide" data-plugin="custommodal"
                                data-overlaySpeed="200" data-overlayColor="#36404a"><i
                                    class="fa fa-plus-circle mr-1"></i> Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataUserTable" class="display text-dark" width="100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM user ORDER BY id DESC";
                                        $query = $conn->query($sql);
                               
                                        $number = 1;
                                    ?>
                                    <?php while($data = $query->fetch_assoc()) :  ?>
                                    <tr>
                                        <td style="color: #000000;"><?= $number++ ?></td>
                                        <td style="color: #000000;"><?php echo $data['nama'];?></td>
                                        <td style="color: #000000;"><?php echo $data['username'];?></td>
                                        <td>
                                            <div class="button-list">
                                                <button type="button" data-toggle="modal" data-target="#editUser"
                                                    onclick="editData('<?=$data['id']?>', '<?=$data['nama']?>', '<?=$data['username']?>')"
                                                    class="btn btn-warning btn-xs text-white"><i
                                                        class="fa fa-edit mr-1"></i>Edit</button>
                                                <form style="display: inline" action="manajemen-user-back/delete.php"
                                                    method="post">
                                                    <input type="hidden" name="id_delete" value="<?= $data['id'] ?>">
                                                    <button type="button" onclick="deleteData(this)"
                                                        class="btn btn-xs btn-danger" id="deleteButton"><i
                                                            class="fa fa-trash mr-1"></i> Hapus</button>
                                                </form>
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
        <div class="modal fade" id="addUser">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="manajemen-user-back/create.php" method="post" id="addUserForm"
                            enctype="multipart/form-data">

                            <input type="hidden" name="create" value="create_data">

                            <div class="form-group">
                                <label for="nama_lengkap">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                            </div>

                            <div class="form-group">
                                <label for="period">Password<span class="text-danger">*</span></label>
                                <div class="input-group mb-1">
                                    <input class="form-control" type="password" name="password" id="passwordId"
                                        placeholder="Masukan Password Anda" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary fa fa-eye toggle-password tombol"
                                            type="button"></button>
                                    </div>
                                </div>
                                <label for="passwordId" id="passwordV" generated="true" class="error"></label>
                                <script>
                                if (document.getElementById('passwordV').innerHTML == "") {
                                    document.getElementById('passwordV').style.display = "none";
                                }
                                </script>
                            </div>

                            <div class="form-group">
                                <label for="period">Password Confirmation<span class="text-danger">*</span></label>
                                <div class="input-group mb-1">
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="passwordConfirm" placeholder="Masukan Konfirmasi Password Anda"
                                        autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary fa fa-eye toggle-password-confirm"
                                            type="button"></button>
                                    </div>
                                </div>
                                <label for="passwordConfirm" id="password_confirm" generated="true"
                                    class="error"></label>
                                <script>
                                if (document.getElementById('password_confirm').innerHTML == "") {
                                    document.getElementById('password_confirm').style.display = "none";
                                }
                                </script>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="tambahUserButton">Simpan
                            Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editUser">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="manajemen-user-back/update.php" method="post" id="editUserForm"
                            enctype="multipart/form-data">

                            <input type="hidden" name="edit" value="edit_data">
                            <input type="hidden" name="edit_id_user">

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" name="edit_nama" placeholder="Masukan Nama">
                            </div>

                            <div class="form-group">
                                <label for="edit_username">Username</label>
                                <input type="text" name="edit_username" class="form-control"
                                    placeholder="Masukan Username">
                            </div>

                            <div class="form-group">
                                <label for="period">Password</label>
                                <div class="input-group mb-1">
                                    <input class="form-control" type="password" name="edit_password" id="editPassword"
                                        placeholder="Masukan Password Anda" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary fa fa-eye toggle-edit-password tombol"
                                            type="button"></button>
                                    </div>
                                </div>
                                <label for="editPassword" id="editPasswordV" generated="true" class="error"></label>
                                <script>
                                if (document.getElementById('editPasswordV').innerHTML == "") {
                                    document.getElementById('editPasswordV').style.display = "none";
                                }
                                </script>
                            </div>

                            <div class="form-group">
                                <label for="period">Password Confirmation</label>
                                <div class="input-group mb-1">
                                    <input class="form-control" type="password" name="edit_password_confirmation"
                                        id="editPasswordConfirm" placeholder="Masukan Konfirmasi Password Anda"
                                        autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary fa fa-eye toggle-edit-password-confirm"
                                            type="button"></button>
                                    </div>
                                </div>
                                <p id="edit_password_confirm" class="edit_password_confirm"></p>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="editUserButton">Simpan
                            Data</button>
                    </div>
                    </form>
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
    var table = $('#dataUserTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excel',
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
        }],
    });
});


// const updateLink = $('#editUserForm').attr('action');
const idForm = $('#editUserForm').attr('id');

function editData(dataId, nama, username) {

    // make form id unique for jquery validaiton
    $('#editUserForm').attr('id', `${idForm}${dataId}`);
    // $('#editUserForm' + dataId).attr('action', `${updateLink}/${dataId}`);

    $('[name="edit_id_user"]').val(dataId);
    $('[name="edit_nama"]').val(nama);
    $('[name="edit_username"]').val(username);

    validateFormEdit(dataId);
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$("#addUserForm").validate({
    rules: {
        username: {
            required: true,
        },
        nama: {
            required: true,
        },
        password: {
            required: true,
        },
        password_confirmation: {
            required: true,
            equalTo: "#passwordId"
        },
    },
    messages: {
        username: {
            required: "Username.",
        },
        nama: {
            required: "Nama harus di isi.",
        },
        password: {
            required: "Password harus di isi.",
        },
        password_confirmation: {
            required: "Konfirmasi Password harus di isi",
            equalTo: "Konfirmasi Password tidak sama"
        },
    },
    submitHandler: function(form) {
        $("#tambahUserButton").prop('disabled', true);
        form.submit();
    }
});

function validateFormEdit(dataId) {
    $("#editUserForm" + dataId).validate({
        rules: {
            edit_username: {
                required: true,
            },
            edit_nama: {
                required: true,
            }
        },
        messages: {
            edit_username: {
                required: "Username harus di isi",
            },
            edit_nama: {
                required: "Nama harus di isi",
            }
        },
        submitHandler: function(form) {
            $("#editUserButton").prop('disabled', true);
            form.submit();
        }
    });
}

function deleteData(e) {
    Swal.fire({
        title: "Hapus data user?",
        text: `Data user akan terhapus. Anda tidak akan dapat mengembalikan
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

// password show/hide toggle
$(".toggle-password").click(function() {
    $(this).toggleClass("far fa-eye-slash");
    var password = document.getElementById("passwordId");
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }

});

// password confirm show/hide toggle
$(".toggle-password-confirm").click(function() {
    $(this).toggleClass("far fa-eye-slash");
    var passwordConfirm = document.getElementById("passwordConfirm");

    if (passwordConfirm.type === "password") {
        passwordConfirm.type = "text";

    } else {
        passwordConfirm.type = "password";
    }

});

// edit password show/hide toggle
$(".toggle-edit-password").click(function() {
    $(this).toggleClass("far fa-eye-slash");
    var editPassword = document.getElementById("editPassword");

    if (editPassword.type === "password") {
        editPassword.type = "text";

    } else {
        editPassword.type = "password";
    }

});

// edit password confirm show/hide toggle
$(".toggle-edit-password-confirm").click(function() {
    $(this).toggleClass("far fa-eye-slash");
    var editPasswordConfirm = document.getElementById("editPasswordConfirm");

    if (editPasswordConfirm.type === "password") {
        editPasswordConfirm.type = "text";

    } else {
        editPasswordConfirm.type = "password";
    }

});

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

// TAMBAH DATA CONTROLLER SWETALERT
</script>
<?php
    include('layouts/bottom.php');
?>