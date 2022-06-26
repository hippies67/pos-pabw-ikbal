<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - KASIR</title>
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="app-assets/icons/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="app-assets/icons/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="app-assets/icons/favicon/favicon-16x16.png">
    <link rel="manifest" href="app-assets/icons/favicon/site.webmanifest">

    <link href="app-assets/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link href="app-assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body class="h-100">
  <section class="h-100 gradient-form" style="background-color: rgb(248, 248, 248);">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-6">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-12">
                <div class="card-body p-md-5 mx-md-4">
  
                  <div class="text-center">
                    <span class="brand-title text-primary" style="font-size: 68px;"><i class="bi bi-pc-display-horizontal mr-2"></i></span>
                    <!-- <img src="app-assets/images/SIKASEP.png" style="width: 100px;" alt="logo"> -->
                    <br>
                    <h5 class="login-heading mt-3">LOGIN ADMIN</h5>
                  </div>
  
                  <form action="cek_login.php" method="POST" class="mt-5">

                    <div class="form-outline mb-4">
                      <label class="form-label" for="username">Username</label>
                      <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>
  
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example22">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>
  
                    <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Log in</button>
                    </div>
                  </form>
  
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="app-assets/vendor/global/global.min.js"></script>
    <script src="app-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="app-assets/js/custom.min.js"></script>
    <script src="app-assets/js/deznav-init.js"></script>

    <script src="app-assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
      <?php

      ?>
        // LOGIN CONTROLLER SWETALERT
        <?php if(isset($_SESSION['error'])) :?>
            Swal.fire({
                title: "Error!",
                text: `Username atau password salah!`,
                type: "error",
            });
        <?php endif ?>
        
        <?php 
           unset($_SESSION['error']);
        ?>

        <?php if(isset($_SESSION['success'])) :?>
            Swal.fire({
                title: "Berhasil!",
                text: `Logout telah berhasil!`,
                type: "success",
            });
        <?php endif ?>

        <?php 
            unset($_SESSION['success']);
        ?>

    </script>
</body>

</html>
