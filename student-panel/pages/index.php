<?php
session_start();
if(!isset($_SESSION['StudentID'])){
  echo header("Location: login.php");
}
include_once("../connections/connection.php");
$con = connection();

$sql = "SELECT * FROM tbl_studentinfo WHERE studentnumber = '".$_SESSION['StudentID']."';";

$user = $con->query($sql) or die ($con->error);//if wrong query kill the connections (students is the query)

$user = $user->fetch_assoc();// for getting the admin credentials it is like a array to access data like profile simply user['profilepic']

?>

<!DOCTYPE html>
<html lang="en">
<style>
  table{
    border-collapse: collapse;
    width: 100%;
    border : 1px solid #4CA4F3;
  }
  th, td{
    
    margin: 0;
    padding: 8px;
    border-bottom: 1px solid #4CA4F3;
  }
  tr:nth-child(even){
    background-color: lightblue;
  }
   th{
    background-color: lightblue;
   }
  </style>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student Portal Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/globe-client-logo.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

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


<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../img/globe-client-logo.png" alt="">
        <span class="d-none d-lg-block">My Student Portal</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown">

<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
  <i class="bi bi-bell"></i>
  <span class="badge bg-primary badge-number">4</span>
</a><!-- End Notification Icon -->

<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
  <li class="dropdown-header">
    You have 4 new notifications
    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
  </li>
  <li>
    <hr class="dropdown-divider">
  </li>

  <li class="notification-item">
    <i class="bi bi-exclamation-circle text-warning"></i>
    <div>
      <h4>Lorem Ipsum</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>30 min. ago</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>

  <li class="notification-item">
    <i class="bi bi-x-circle text-danger"></i>
    <div>
      <h4>Atque rerum nesciunt</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>1 hr. ago</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>

  <li class="notification-item">
    <i class="bi bi-check-circle text-success"></i>
    <div>
      <h4>Sit rerum fuga</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>2 hrs. ago</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>

  <li class="notification-item">
    <i class="bi bi-info-circle text-primary"></i>
    <div>
      <h4>Dicta reprehenderit</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>4 hrs. ago</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>
  <li class="dropdown-footer">
    <a href="#">Show all notifications</a>
  </li>

</ul><!-- End Notification Dropdown Items -->

</li><!-- End Notification Nav -->
       

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            
            <?php  echo '<img src="../../uploads/'.$user['profile_url'].'" alt="Profile" class="rounded-circle"  />';
   ?> 
            <?php
                echo '<span class="d-none d-md-block dropdown-toggle ps-2">'.$user['firstname'].' '.$user['lastname'].'</span>' ;
                ?>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $user['firstname'].' '.$user['lastname']?></h6>
              <span><?php echo $user['course']?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

        
            </li>

           

            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out
                </span>
               
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


 

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <?php  echo '<img src="../../uploads/'.$user['profile_url'].'" alt="Profile" class="rounded-circle"  />';
               ?> 
              <?php echo '<h2>'.$user['firstname'].' '.$user['lastname'].'</h2>' 
              ?>
              
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Student Information</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Grades</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Schedules</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Bills</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
               
                  

                  <h5 class="card-title">Profile Details</h5>
                  <input type ="hidden" id="studentNumber" value ="<?php echo $_SESSION['StudentID']?>">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <?php echo '<div class="col-lg-9 col-md-8">'.$user['firstname'].' '.$user['lastname'].'</div>' 
              ?>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label" >Student Number</div>
                    <?php echo '<div class="col-lg-9 col-md-8">'.$user['studentnumber'].'</div>' 
               ?>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Course</div>
                    <?php echo '<div class="col-lg-9 col-md-8">'.$user['course'].'</div>' 
               ?>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Section</div>
                    <?php echo '<div class="col-lg-9 col-md-8">'.$user['section'].'</div>' 
               ?>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Birth Day</div>
                    <?php echo '<div class="col-lg-9 col-md-8">'.$user['birthday'].'</div>' 
               ?>
                  </div>

               
                </div>
              

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->


                  <form method="POST" action="#" >
               
                  <table>
                       <thead>
                     <tr>
                         <th>SUBJECT CODE</th>
                         <th>SUBJECT NAME</th>
                         <th>UNITS</th>
                         <th>GRADES</th>
                       </tr>
                       </thead>
                       <tbody id="grade-table-body">
               
                       
                       </tbody>
                     </table>
                 
                
                   
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                  <table>
                       <thead>
                     <tr>
                         <th>SUBJECT NAME</th>
                         <th>SCHEDULE</th>
                         <th>INSTRUCTOR</th>
                     </tr>
                       </thead>
                       <tbody id="schedule-table-body">
               
                       
                       </tbody>
                     </table>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>
                  <table>
                       <thead>
                         <tr>
                           <th style="background-color:#4CA4F3"></th>
                         <th style="background-color:#4CA4F3;" ><center>SUBJECTS</center></th>
                         <th style="background-color:#4CA4F3"></th>
                         </tr>
                     <tr>
                         <th>NAME</th>
                         <th></th>
                         <th>AMOUNT</th>
                     </tr>
                       </thead>
                       <tbody id="subject-fee-table-body">
               
                       
                       </tbody>
                       <thead>
                       <th style="background-color:#4CA4F3"></th>
                         <th style="background-color:#4CA4F3"><center>MISCELLANEOUS FEE</center></th>
                         <th style="background-color:#4CA4F3"></th>
                         <tr>
                         <th>NAME</th>
                         <th></th>
                         <th>AMOUNT</th>
                         </tr>
                     </tr>
                       </thead>
                       <tbody id="misc-fee-table-body">
               
                       
                       </tbody>
                     </table>

                  

                   
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- MY JAVASCRIPT -->
  <script src ="../js/index.js?t=1491313943549"  type = "text/javascript"></script>

  <!-- END OF MY JAVASCRIPT -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Footer</span></strong>. All Rights Reserved
    </div>
   
  </footer><!-- End Footer -->

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

</body>

</html>