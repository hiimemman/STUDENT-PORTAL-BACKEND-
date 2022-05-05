
<?php
if(!isset($_SESSION)){
  session_start();//if there is no session then start session
} //Session lol

if(isset($_SESSION['UserLogin'])){
  echo header("Location: admin-dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/globe-client-logo.png" rel="icon">
  <link href="../img/client-logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">

  <!-- Toastr css file -->
  <link href="../css/toast.css" rel="stylesheet">

  <!-- Toastr js file -->
 
</head>

<body>

  <main>
     
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="card" id ="cardSpinner" hidden="hidden">
            <div class="card-body">
              <h5 class="card-title">Sizes</h5>
              <p>Add <code>.spinner-border-sm</code> and <code>.spinner-grow-sm</code> to make a smaller spinner that can quickly be used within other components. Or, use custom CSS or inline styles to change the dimensions as needed.</p>

              <!-- Sized spinners -->
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>

              <div class="spinner-border" style="width: 30px; height: 30px;" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>

              <div class="spinner-border" style="width: 40px; height: 40px;" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>

              <div class="spinner-border" style="width: 50px; height: 50px;" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>

              <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>

              <div class="spinner-grow" style="width: 30px; height: 30px;" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>

              <div class="spinner-grow" style="width: 40px; height: 40px;" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>

              <div class="spinner-grow" style="width: 50px; height: 50px;" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              <!-- End Sized spinners -->

            </div>
          </div>  
      
      <div class="container" id ="containerLogin">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="admin-dashboard.php" class="logo d-flex align-items-center w-auto">
                  <img src="../img/globe-client-logo.png" alt="">
                  <span class="d-none d-lg-block">Admin Panel</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate id ="loginForm">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
              
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login" id ="btnLogin">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Forget your account? <a href="pages-register.html">Request for recovery</a></p>
                    </div>
                  </form>

                </div>
              </div>

             
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/chart.js/chart.min.js"></script>
  <script src="../vendor/echarts/echarts.min.js"></script>
  <script src="../vendor/quill/quill.min.js"></script>
  <script src="../vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../vendor/tinymce/tinymce.min.js"></script>
  <script src="../vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../js/main.js"></script>
  <!-- User Login AJAX -->
  <script src="../js/user-login.js"></script>
</body>

</html>