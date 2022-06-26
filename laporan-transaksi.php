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

table.dataTable thead th {
    color: #fff;
    font-size: 16px;
    white-space: nowrap;
    font-weight: 600;
}
</style>

<?php 
		$bulan_tes = array(
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
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="indikator_pokok">Laporan Transaksi</a>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <h3>
							<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
								<button class="btn btn-danger">RESET</button>
							</a>-->
							<?php if(!empty($_GET['cari'])){ ?>
								Data Laporan Penjualan <?= $bulan_tes[$_POST['bln']];?> <?= $_POST['thn'];?>
							<?php }elseif(!empty($_GET['hari'])){?>
								Data Laporan Penjualan <?= $_POST['hari'];?>
							<?php }else{?>
								Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
							<?php }?>
						</h3>
						<br/>
						<h4>Cari Laporan Per Bulan</h4>
						<form method="post" action="laporan-transaksi.php?page=laporan&cari=ok">
							<table class="table table-striped">
								<tr>
									<th>
										Pilih Bulan
									</th>
									<th>
										Pilih Tahun
									</th>
									<th>
										Aksi
									</th>
								</tr>
								<tr>
								<td>
								<select name="bln" class="form-control">
									<option selected="selected">Bulan</option>
									<?php
										$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
										$jlh_bln=count($bulan);
										$bln1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
										$no=1;
										for($c=0; $c<$jlh_bln; $c+=1){
											echo"<option value='$bln1[$c]'> $bulan[$c] </option>";
										$no++;}
									?>
									</select>
								</td>
								<td>
								<?php
									$now=date('Y');
									echo "<select name='thn' class='form-control'>";
									echo '
									<option selected="selected">Tahun</option>';
									for ($a=2017;$a<=$now;$a++)
									{
										echo "<option value='$a'>$a</option>";
									}
									echo "</select>";
									?>
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="laporan-transaksi.php?page=laporan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>
										
									<?php if(!empty($_GET['cari'])){?>
										<a href="excel.php?cari=yes&bln=<?=$_POST['bln'];?>&thn=<?=$_POST['thn'];?>" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
										<a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
								</tr>
							</table>
						</form>
						<form method="post" action="laporan-transaksi.php?page=laporan&hari=cek">
							<table class="table table-striped">
								<tr>
									<th>
										Pilih Hari
									</th>
									<th>
										Aksi
									</th>
								</tr>
								<tr>
								<td>
									<input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="hari">
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="laporan-transaksi.php?page=laporan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>
										
									<?php if(!empty($_GET['hari'])){?>
										<a href="excel.php?hari=cek&tgl=<?= $_POST['hari'];?>" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
										<a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
								</tr>
							</table>
						</form>
						<div class="clearfix" style="border-top:1px solid #ccc;"></div>
						<br/>
						<br/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Laporan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataUserTable" class="table table-bordered" width="100%;">
                                <thead>
                                    <tr style="background:#0B2A97;">
										<th> No</th>
										<th> ID Barang</th>
										<th> Nama Barang</th>
										<th> Jumlah</th>
										<th> Modal</th>
										<th> Total</th>
										<th> Tanggal Input</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php 
										$no=1; 
										if(!empty($_GET['cari'])){
											$periode = $_POST['bln'].'-'.$_POST['thn'];
											$no=1; 
											$jumlah = 0;
											$bayar = 0;
                                            $sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli from nota 
                                            left join barang on barang.id_barang=nota.id_barang WHERE nota.periode = '$periode'
                                            ORDER BY id_nota ASC";
                                            $query = $conn->query($sql);
										}elseif(!empty($_GET['hari'])){
											$hari = $_POST['hari'];
											$no=1; 
											$jumlah = 0;
											$bayar = 0;
                                            
                                            $ex = explode('-', $hari);
                                            $monthNum  = $ex[1];
                                            $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
                                            if($ex[2] > 9)
                                            {
                                                $tgl = $ex[2];
                                            }else{
                                                $tgl1 = explode('0',$ex[2]);
                                                $tgl = $tgl1[1];
                                            }
                                            $cek = $tgl.' '.$monthName.' '.$ex[0];
                                            $param = "%{$cek}%";
                                            $sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli from nota 
                                                left join barang on barang.id_barang=nota.id_barang WHERE nota.tanggal_input LIKE '$param' 
                                                ORDER BY id_nota ASC";
                                            $query = $conn->query($sql);
										}else{
                                            $sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli from nota 
                                            left join barang on barang.id_barang=nota.id_barang 
                                            ORDER BY id_nota DESC";
                                            $query = $conn->query($sql);
										}
									?>
									<?php 
										$bayar = 0;
										$jumlah = 0;
										$modal = 0;
										foreach($query as $isi){ 
											$bayar += $isi['total'];
											$modal += $isi['harga_beli']* $isi['jumlah'];
											$jumlah += $isi['jumlah'];
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['id_barang'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['jumlah'];?> </td>
										<td>Rp.<?php echo number_format($isi['harga_beli']* $isi['jumlah']);?>,-</td>
										<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
                                </tbody>
                                <tfoot>
									<tr>
										<th colspan="2">Total Terjual</td>
										<th><?php echo $jumlah;?></td>
										<th>Rp.<?php echo number_format($modal);?>,-</th>
										<th>Rp.<?php echo number_format($bayar);?>,-</th>
										<th style="background:#0bb365;color:#fff;">Keuntungan</th>
										<th style="background:#0bb365;color:#fff;">
											Rp.<?php echo number_format($bayar-$modal);?>,-</th>
									</tr>
								</tfoot>
                            </table>
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
            extend: 'print',
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


// TAMBAH DATA CONTROLLER SWETALERT
</script>
<?php
    include('layouts/bottom.php');
?>