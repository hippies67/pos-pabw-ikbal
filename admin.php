
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DATA USER</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    
    <style>
    .height10 {
        height: 10px;
    }

    .mtop10 {
        margin-top: 10px;
    }

    .modal-label {
        position: relative;
        top: 7px
    }

    .alert-success {
        color: #ffffff;
        background-color: #6558f5;
        border-color: #ffffff;
    }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                <div class="row">
                    <?php
				if(isset($_SESSION['error'])){
					echo
					"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo
					"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
                
			?>
                </div>
                <div class="row">
                    <h1 class="text-left" style="font-weight: bold;">DATA USER - <?= $_SESSION['auth_username'] ?></h1>
                    <div class="d-flex">
                        <a href="#addnew" data-toggle="modal" class="btn"
                            style="background-color: #6558f5; color: #ffffff;margin-top: 15px;margin-bottom: 15px;">Buat
                            User</a>
                        <a href="#logout" data-toggle="modal" class="btn"
                            style="background-color: #6558f5; color: #ffffff;margin-top: 15px;margin-bottom: 15px;">Logout</a>

                    </div>
                </div>
                <div class="height10">
                </div>
                <div class="row">

                    <table class="table table-bordered">
                        <thead>
                            <th>Userame</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
						

							//use for MySQLi-OOP
							
							while($row = $query->fetch_assoc()){
								echo 
								"<tr>
									<td>".$row['username']."</td>
									<td>".$row['password']."</td>
									<td>
										<a href='#edit_".$row['id']."' class='btn btn-sm' data-toggle='modal' style='background-color: #6558f5; color: #ffffff;'>Ubah User</a>
										<a href='#delete_".$row['id']."' class='btn btn-sm' data-toggle='modal' style='background-color: #6558f5; color: #ffffff;'>Hapus User</a>
									</td>
								</tr>";
								include('edit_delete_modal.php');
							}
						?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include('add_modal.php') ?>

    <?php include('logout_modal.php') ?>

    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- generate datatable on our table -->
    <script>
    $(document).ready(function() {
        //inialize datatable

        //hide alert
        $(document).on('click', '.close', function() {
            $('.alert').hide();
        })
    });
    </script>
</body>

</html>