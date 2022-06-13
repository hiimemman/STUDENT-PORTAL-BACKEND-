<?php
session_start();
if(!isset($_SESSION['ID'])){
  echo header("Location: admin-login.php");
}
include_once("../connections/connection.php");
$con = connection();

$sql = "SELECT * FROM tbl_admin WHERE id = '".$_SESSION['ID']."';";

$user = $con->query($sql) or die ($con->error);//if wrong query kill the connections (students is the query)

$user = $user->fetch_assoc();// for getting the admin credentials it is like a array to access data 

$currentId = $user['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Archived / Subjects</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/globe-client-logo.png" rel="icon">
  <link href="../img/globe-client-logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"

  <!-- Vendor CSS Files -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- Custom table csss -->

<link href="../css/Mytable.css" rel="stylesheet">
 <!-- End of custom table css -->
  <!-- Template Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">
 
</head>

<body>

  <!-- TOASTER -->


  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    
    <div class="d-flex align-items-center justify-content-between">
      <a href="admin-dashboard.php" class="logo d-flex align-items-center">
        <img src="../img/globe-client-logo.png" alt="">
        <span class="d-none d-lg-block">Employee Portal</span>
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


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

<?php

echo '<img src="../../uploads/'.$user['profile_url'].'" alt="Profile" class="rounded-circle"  />';
?>
                <?php
                echo '<span class="d-none d-md-block dropdown-toggle ps-2">'.$user['username'].'</span>' ;
                ?>
            
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
               <?php
                echo '<h6>'.$user['firstname'].' '.$user['lastname'].'</h6>' ;
                ?>
               <?php
                echo '<span>'.$user['position'].'</span>' ;
                ?>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="user-profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="admin-logout.php">
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

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->



      <li class="nav-heading">Pages</li>


      <?php if($_SESSION['Position'] == 'Admin'){
  echo '<li class="nav-item">
  <a class="nav-link collapsed" href="user-accounts.php">
    <i class="bi bi-people-fill"></i>
    <span>Employee Account</span>
  </a>
</li><!-- End User Account Nav -->';
}
?>

      <li class="nav-item">
        <a class="nav-link collapsed " href="admin-student-accounts.php">
          <i class="bi bi-person-square"></i>
          <span>Student Account</span>
        </a>
      </li><!-- End Student Account Nav -->

      <li class="nav-item">
        <a class="nav-link" href="subject.php">
          <i class="bi bi-book"></i>
          <span>Subjects</span>
        </a>
      </li><!-- End Subject Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed " href="courses.php">
          <i class="bx bxs-graduation"></i>
          <span>Courses</span>
        </a>
      </li><!-- End Archives Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed " href="section.php">
          <i class="bi bi-person-lines-fill"></i>
          <span>Section</span>
        </a>
      </li><!-- End Archives Nav -->

       <li class="nav-item">
        <a class="nav-link collapsed " href="miscellaneous-fee.php">
          <i class="bi bi-currency-dollar"></i>
          <span>Miscellaneous Fee</span>
        </a>
      </li><!-- End Archives Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed " href="announcement.php">
          <i class="bi bi-megaphone-fill"></i>
          <span>Announcement</span>
        </a>
      </li><!-- End Archives Nav -->

    
      <li class="nav-item">
        <a class="nav-link collapsed " href="audit.php">
          <i class="bi bi-file-earmark-medical"></i>
          <span>Activity Log</span>
        </a>
      </li><!-- End Archives Nav -->
      <li class="nav-heading">Settings</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="user-profile.php">
    <i class="bi bi-person-circle"></i>
    <span>Profile</span>
  </a>
</li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
            
 <!--Error Alert -->
 <div class="alert alert-danger alert-dismissible fade" hidden role="alert" id="alertError" style ="position:fixed; z-index: 9999;width:fit-content; left:40%; top:10%;"> 
                <i class="bi bi-exclamation-octagon me-1"></i>
          Please fill out all the fields!
              </div><!--Error End of Alert -->

              <!-- Success Alert -->
              <div class="alert alert-success alert-dismissible fade" hidden role="alert" id="alertSuccess" style ="position:fixed; z-index: 9999;width:fit-content; left:40%; top:10%;"> 
                <i class="bi bi-exclamation-octagon me-1" id ="alertSuccessMessage"></i>
              </div><!-- End of Alert -->
    <div class="pagetitle">
      <h1>Archived Subjects</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Archived Subjects</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


     <!-- Are you sure you want to archived -->
              <div class="modal fade" id="archivedModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="archive-modal-title">Are you sure archived this?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer" id="modal-footer-button">
                     
                    </div>
                  </div>
                </div>
              </div><!-- End  Are you sure you want to archived-->


    <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id ="modalMainMessage">Updated Succesfully!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick ="refreshTable()"></button>
                      </div>
                    <div class="modal-body">
                     <p id="modalLogs"></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" onClick ="refreshTable()"data-bs-dismiss="modal">Close</button>
                      <script> function reloadPage(){location.reload()}</script>
                    </div>
                  </div>
                </div>
              </div><!-- End of change pic modal-->

               

                <!-- Change profile picture Modal -->

              <div class="modal" id="changeProfileModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Change Profile Picture</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"onClick ="refreshTable()"></button>
                    </div>
                    <input type ="hidden" id ="changePicUserID" ><!-- User id -->
                    <div class="modal-body" >
                      <div id="changePicModalBody" >

                      </div>
                    <label for="editUserPic" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
              <div class="col-md-12 col-lg-9">
             <input class="form-control" type ="file" name = "profileEdit" id ="editUserPic" onchange="editProfilePic()">
            </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"onClick ="refreshTable()">Close</button>
                      <div id="showSave">
                     <button type="button" disabled class="btn btn-primary" >Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End of change profile picture Modal -->

                <!--------------------------------------------Edit user Modal ------------------------------------------------------->
              
                <div class="modal fade" id="editusermodal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Accounts Form</h5>
                      
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"onClick ="refreshTable()"></button>
                      
                    </div>
                    <div class="modal-body">

              

              <!-- Floating Labels Form -->
              <form class="row g-3 needs-validation" id ="frmEditUsers">
              
              <input type="hidden" id="editId">
              
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editFname" placeholder="Firstname" required>
                    <label for="editFname">Firstname</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editMname" placeholder="Middlename">
                    <label for="editMname">Middlename</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editLname" placeholder="Lastname">
                    <label for="newLname">Lastname</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="editEmail" placeholder="Email">
                    <label for="editEmail">Email</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editUsername" placeholder="Username">
                    <label for="editUsername">Username</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="editPassword" placeholder="Password">
                    <label for="editPassword">Password</label>
                  </div>
                </div>

               
                
               
                <div class="col-md-4">
                <div class="form-floating mb-3">
                      <select class="form-select" id="editJob" aria-label="Floating label select example">
                        <option selected disabled>...</option>
                        <option value="Admin">Admin</option>
                        <option value="Registrar">Registrar</option>
                        <option value="Accountant">Accountant</option>
                      </select>
                      <label for="editJob">Position</label>
                    </div>
                </div>

                <div class = "col-md-4">
                  <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="editBirthday" placeholder="Birthday">
                    <label for ="editBirthday">Birthdate</label>
                  </div>
                </div>

                <div class = "col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editContact" placeholder="Contact">
                    <label for="editContact">Contact</label>
                  </div>
                </div>

                <div class="col-md-1">
                  <legend class="col-form-label col-sm-2 pt-0">Sex</legend>
                </div>

                <fieldset class="col-md-3">
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="editmaleCheck" value="Male">
                      <label class="form-check-label" for="gridRadios1">
                        Male
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="editfemaleCheck" value="Female" > 
                      <label class="form-check-label" for="gridRadios2">
                        Female
                      </label>
                    </div>
                  </div>
                </fieldset>


                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="editAddress" style="height: 100px;"></textarea>
                    <label for="editAddress">Address</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="About" id="editAbout" style="height: 100px;"></textarea>
                    <label for="editAbout">About</label>
                  </div>
                </div>
              

                    <label for="basic-url" class="form-label">Optional URL</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" >https://twitter.com/</span>
                      <input type="text" class="form-control" id="edittwitterprofileURL" aria-describedby="basic-addon3">
                    </div>
                    <div class ="input-group mb-3">
                      <span class="input-group-text" >https://facebook.com/</span>
                      <input type="text" class="form-control" id="editfacebookprofileURL" aria-describedby="basic-addon3">
                    </div>
                    <div class ="input-group mb-3">
                      <span class="input-group-text" >https://instagram.com/</span>
                      <input type="text" class="form-control" id="editinstagramprofileURL" aria-describedby="basic-addon3">
                    </div>
                    <div class ="input-group mb-3">
                      <span class="input-group-text" >https://linkedin.com/</span>
                      <input type="text" class="form-control" id="editlinkedinprofileURL" aria-describedby="basic-addon3">
                    </div>
              </form><!-- End floating Labels Form -->
                    </div>
                    <div class="modal-footer">
                      
                     
                      <button class="btn btn-primary" type="button" disabled id ="btnIsUpdating" hidden>
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Updating...
                      </button><!--End of updating button-->
                      <button class="btn btn btn-danger" type="button" disabled id ="btnEditError" hidden>
                      <i class="bi bi-exclamation-octagon"></i>
                      Error!
                      </button><!-- End of error button -->
                      
                      <button type="submit" class="btn btn-primary" id ="btnEditUsers" onClick ="checkEditFields()">Submit</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick ="refreshTable()">Cancel</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Edit user Modal-->
            

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card" >
            <div class="card-body" >
            <h5 class="card-title">Archived Subject Table</h5>
      <!-- scroll table --> 
      <!-- Select Entry Page -->  
      <div class ="row mb-1">
<div class ="col-sm-2">
          <a href ="subject.php" class="btn btn-secondary" style ="margin:5px;">
              <i class="ri-arrow-go-back-fill"></i> 
              </a>
            </div>
</div>
      <div class="row mb-3">
      
       

       </div>

      <div class="row mb-3">
                  <div class="col-sm-2">
                    <select class="form-select" aria-label="Default select example" id ="selectPage" onchange="selectNumPage()">
                    
                    </select>
                  </div>
                  <label for ="selectPage"class="col-sm-2 col-form-label">Rows</label>

                <!-- Space between rows and searchbar -->
                  <div class="col-sm-5 col-lg-3">
                  </div>
                  <!-- End of Space between rows and searchbar -->
                  <!-- Search bar -->
                  <div class="col-sm-2 col-lg-5">
                    <div class ="search-bar">
                      <input class="form-control" type ="text" placeholder="Search..." title="Enter search keyword" id="userSearchBar" onkeyup="userSearchKey()" >
                     </div>
                    </div><!--End of search bar-->
                  </div> 
      <!-- End of Select Entry Page -->
    
              <div id="table-wrapper">
                <div id="table-scroll">
              <!-- Table -->
              
              <table class="table table-hover"  id ="tblUsers">
                <thead id ="tblThead">
                  <tr class="table-primary">
                      <th scope="col" class ="header-title"><a href= "#" onclick ="sortCurrentTable('subject_code');return false;" class="th-a">SUBJECT CODE</a> </th>
                    <th scope="col" class ="header-title"><a href= "#" onclick ="sortCurrentTable('subject_name');return false;" class="th-a">SUBJECT NAME</a></th>
                    <th scope="col" class ="header-title"><a href= "#" onclick ="sortCurrentTable('units');return false;" class="th-a">UNITS</a></th>
                    <th scope="col" class ="header-title"><a href= "#" onclick ="sortCurrentTable('status');return false;" class="th-a">DATE REMOVED</a></th>
                    <th scope="col" class="table-info" id ="th-action">ACTIONS</th>
                    
                    
                  </tr>
                </thead>
                <tbody id ="tbody-user-accounts">
                 
                </tbody>
              </table>
              <!-- Table -->

  </div>
  </div>
  <!-- End for scroll table -->
  <div class ="row g-3">
   <div class="col-6" id ="showNumberOfPage">
         
     </div>
     
     
   <!-- Pagination with icons -->

              <div class="col-6">
                <ul class="pagination justify-content-end">
                  <li class="page-item" >
                  <a class="page-link" aria-label="Previous" id="prevPage">
                    <span aria-hidden="true">&laquo;</span>
                        </a>
                          </li>
                          <!-- <li class="page-item"><a class="page-link" id= "page1">1</a></li>
                          <li class="page-item"><a class="page-link" id= "page2">2</a></li>
                          <li class="page-item"><a class="page-link" id= "page3">3</a></li> -->
                          <li class="page-item">
                          <a class="page-link" aria-label="Next" id ="nextPage" >
                       <span aria-hidden="true">&raquo;</span>
                    </a> 
                  </li>
                </ul>      
            </div>
  </div><!-- row g-3 -->
              <!-- End Pagination with icons -->



  <!-- practiec-->
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Footer</span></strong>. All Rights Reserved
    </div>
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  

  <!-- my javascript for user-prfile -->
  <script src="../vendor/jquery-3.6.0.min.js?t=1491313943549"></script>
<script src ="../js/archived-subjects.js?t=1491313943549"  type = "text/javascript"></script>
<!-- end of my javascript for user - profile -->

  <!-- Vendor JS Files -->
  <script src="../vendor/apexcharts/apexcharts.min.js?t=1491313943549"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js?t=1491313943549"></script>
  <script src="../vendor/chart.js/chart.min.js?t=1491313943549"></script>
  <script src="../vendor/echarts/echarts.min.js?t=1491313943549"></script>
  <script src="../vendor/quill/quill.min.js?t=1491313943549"></script>
  
 <script src="../vendor/simple-datatables/simple-datatables.js?t=1491313943549"></script> 
  <script src="../vendor/tinymce/tinymce.min.js?t=1491313943549"></script>
 
  <!-- Template Main JS File -->
  <script src="../js/main.js?t=1491313943549"></script>

</body>

</html>