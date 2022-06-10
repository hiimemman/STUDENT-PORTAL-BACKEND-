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

  <title>Student / Accounts</title>
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
          <input type ="hidden" id="getUserPosition" value ="<?php echo $_SESSION['Position']?>">
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
        <a class="nav-link" href="admin-student-accounts.php">
          <i class="bi bi-person-square"></i>
          <span>Student Account</span>
        </a>
      </li><!-- End Student Account Nav -->

<<<<<<< HEAD
      <li class="nav-item">
        <a class="nav-link collapsed " href="admin-curriculum.php">
          <i class="bi bi-card-list"></i>
          <span>Curriculum</span>
        </a>
      </li><!-- End Curriculum Nav -->
     
=======

      <li class="nav-item">
        <a class="nav-link collapsed" href="subject.php">
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
>>>>>>> a872ad1a176f7a41a0e4d4c1d7d0f0677759e850
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
            
 <!--Error Alert -->
 <div class="alert alert-danger alert-dismissible fade" hidden role="alert" id="alertError" style ="position:fixed; z-index: 9999;width:fit-content; left:40%; top:10%;"> 
                <i class="bi bi-exclamation-octagon me-1" id ="alertErrorBody"> Please fill out all the fields!</i>
         
              </div><!--Error End of Alert -->

              <!-- Success Alert -->
              <div class="alert alert-success alert-dismissible fade" hidden role="alert" id="alertSuccess" style ="position:fixed; z-index: 9999;width:fit-content; left:40%; top:10%;"> 
                <i class="bi bi-exclamation-octagon me-1" id ="alertSuccessMessage"></i>
              </div><!-- End of Alert -->
    <div class="pagetitle">
      <h1>Student Accounts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Student Accounts</li>
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

               <!--add user Modal -->
              
              <div class="modal fade" id="addusermodal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Students Create Form</h5>
                      
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick ="refreshTable()"></button>
                      
                    </div>
                    <div class="modal-body">

                    
               

              <!-- Floating Labels Form -->
              <form class="row g-3 needs-validation" id ="frmCreateUsers">
                
              <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="newStudNum" placeholder="Student Number" required>
                    <label for="newStudNum">Student Number</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="newFname" placeholder="Firstname" required>
                    <label for="newFname">Firstname</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="newMname" placeholder="Middlename">
                    <label for="newMname">Middlename</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="newLname" placeholder="Lastname">
                    <label for="newLname">Lastname</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="newEmail" placeholder="Email">
                    <label for="newEmail">Email</label>
                  </div>
                </div>
                <div class="col-md-6" hidden>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="newPassword" placeholder="Password">
                    <label for="newPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-12">
                <div class="form-floating mb-3">
                      <select class="form-select" id="newCourse" aria-label="Floating label select example">
                        
                      </select>
                      <label for="newCourse">Course</label>
                    </div>
                </div>
                <div class="col-md-12">
                <div class="form-floating mb-3">
                      <select class="form-select" id="newSection" aria-label="Floating label select example">
                        
                      </select>
                      <label for="newSection">Section</label>
                    </div>
                </div>
                <div class = "col-md-12">
                  <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="newBirthday" placeholder="Birthday">
                    <label for ="newBirthday">Birthdate</label>
                  </div>
                </div>

                <div class = "col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="newContact" placeholder="Contact">
                    <label for="newContact">Contact</label>
                  </div>
                </div>

                <div class="col-md-1">
                  <legend class="col-form-label col-sm-2 pt-0">Sex</legend>
                </div>

                <fieldset class="col-md-3">
                  <div class="col-sm-10">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="radio" name="gridRadios" id="maleCheck" value="Male">
                      <label class="form-check-label" for="gridRadios1">
                        Male
                      </label>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="radio" name="gridRadios" id="femaleCheck" value="Female" > 
                      <label class="form-check-label" for="gridRadios2">
                        Female
                      </label>
                    </div>
                  </div>
                </fieldset>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="newAddress" style="height: 100px;"></textarea>
                    <label for="newAddress">Address</label>
                  </div>
                </div>
                <div class = "col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="newGuardian" placeholder="Guardian Name">
                    <label for="newGuardian">Guardian Name</label>
                  </div>
                </div>
                <div class = "col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="newGuardianContact" placeholder="Guardian Contact">
                    <label for="newGuardianContact">Guardian Contact</label>
                  </div>
                </div>



                  
                   
              </form><!-- End floating Labels Form -->
                    </div>
                    <div class="modal-footer">
                      
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick ="refreshTable()">Cancel</button>
                      <button class="btn btn-primary" type="button" disabled id ="btnIsLoading" hidden>
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Creating...
                      </button><!--End of updating button-->
                      <button class="btn btn btn-danger" type="button" disabled id ="btnError" hidden>
                      <i class="bi bi-exclamation-octagon"></i>
                      Error!
                      </button><!-- End of error button -->
                      <button class="btn btn btn-success" type="button" disabled id ="btnSuccess" hidden>
                      <i class="bi bi-check-circle me-1"></i>
                      Created
                      </button><!-- End of success button -->
                      <button type="submit" class="btn btn-success" id ="btnCreateUsers" onClick ="checkAllFields()">Submit</button>
                     </div>
                  </div>
                </div>
              </div><!-- End user Modal-->

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
             <input class="form-control" type ="file" name = "profileEdit" id ="editUserPic" onchange="checkIfImage()">
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
                      <h5 class="modal-title">Students Update Form</h5>
                      
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"onClick ="refreshTable()"></button>
                      
                    </div>
                    <div class="modal-body">

              

              <!-- Floating Labels Form -->
            
                    </div>
                    <div class="modal-footer">
                      
                     
                     
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick ="refreshTable()">Cancel</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Edit user Modal-->


                <!--------------------------------------------Grade and Result Modal ------------------------------------------------------->
              
                <div class="modal fade" id="gradesmodal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Grades Result and Schedule Form</h5>
                      
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"onClick ="refreshTable()"></button>
                      
                    </div>
                    <div class="modal-body">
              

            
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
                      
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick ="refreshTable()">Back</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Edit user Modal-->

                <!--------------------------------------------Miscellaneus Fee Modal ------------------------------------------------------->
              
                <div class="modal fade" id="feemodal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Miscellaneous Fee Form</h5>
                      
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"onClick ="refreshTable()"></button>
                      
                    </div>
                    <div class="modal-body">
              

         
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
                      
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick ="refreshTable()">Back</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Miscellaneous Fee Modal-->
            
            

    <section class="section" id ="StudentTable">
      <div class="row">
        <div class="col-lg-12">

          <div class="card" >
            <div class="card-body" >
            <h5 class="card-title">Student Accounts Table</h5>
      <!-- scroll table --> 
      <!-- Select Entry Page -->  
     
      <div class="row mb-3">
        <div class="col-sm-4">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addusermodal">
              <i class="bi bi-person-plus"></i>  
             Student
              </button>
              <a href ="archived-students.php" class="btn btn-warning" >
              <i class="bi bi-recycle"></i> 
              </a>
       </div>
   
       <!-- Recycle -->
       <div class="col-sm-2">
              
       </div>
       <!-- End of Recycle -->
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
    
              <div id="gradetable-wrapper">
                <div id="gradetable-scroll">
              <!-- Table -->
              
              <table class="table table-hover"  id ="tblUsers">
                <thead id ="tblThead">
                  <tr class="table-primary">
                    <th scope="col" class ="header-title"><a href= "#" onclick ="sortCurrentTable('profile_url');return false;" class="th-a">PHOTO</a> </th>
                    <th scope="col" class ="header-title"><a href= "#" onclick ="sortCurrentTable('studentnumber');return false;" class="th-a">STUDENT NUMBER</a></th>
                    <th scope="col" class ="header-title"><a href= "#" onclick ="sortCurrentTable('firstname');return false;" class="th-a">FULL NAME</a></th>
                
                    <th scope="col"id ="th-action" style = "position:sticky; right:0%; position: -webkit-sticky; top: 0px;">ACTION</th>
                    
                    
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
<!-- student table -->

<!-- View Student Info -->

<section class="section profile" id ="ViewStudentInfo" hidden>

      <div class="row">
        <div class="col-xl-12">

          <div class="card">
          <button type="button" class="btn btn-secondary" style="margin:10px;width:10%;" onClick ="backToTable();return false;"><i class ="ri-arrow-go-back-fill"></i> Back</button>
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" id="viewProfileCard">

            
            </div>
          </div>

        </div>

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3" >
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" id="swipeEditProfile">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-grades" >Grades and Schedules</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-bills">Bills</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form class="row g-3 needs-validation" id ="frmEditUsers">
              
              <input type="hidden" id="editId">
                 
              <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" disabled id="editStudNum" placeholder="Student Number" required>
                    <label for="editStudNum">Student Number</label>
                  </div>
                </div>

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
                    <label for="editLname">Lastname</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="email" class="form-control" disabled id="editEmail" placeholder="Email">
                    <label for="editEmail">Email</label>
                  </div>
                </div>
                <div class="col-md-6" hidden>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="editPassword" placeholder="Password">
                    <label for="editPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating mb-3">
                      <select class="form-select" id="editCourse" aria-label="Floating label select example">
                        <option selected disabled>...</option>
                        <option value="Admin">Course</option>
                        <option value="Registrar">Registrar</option>
                        <option value="Accountant">Accountant</option>
                      </select>
                      <label for="editCourse">Course</label>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating mb-3">
                      <select class="form-select" id="editSection" aria-label="Floating label select example">
                        <option selected disabled>...</option>
                        <option value="Admin">Course</option>
                        <option value="Registrar">Registrar</option>
                        <option value="Accountant">Accountant</option>
                      </select>
                      <label for="editSection">Section</label>
                    </div>
                </div>
                <div class = "col-md-6">
                  <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="editBirthday" placeholder="Birthday">
                    <label for ="editBirthday">Birthdate</label>
                  </div>
                </div>

                <div class = "col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editContact" placeholder="Contact">
                    <label for="editContact">Contact</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <legend class="col-form-label col-sm-2 pt-0">Sex</legend>
                </div>

                <fieldset class="col-md-3">
                  <div class="col-sm-10">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="radio" name="gridRadios" id="editmaleCheck" value="Male">
                      <label class="form-check-label" for="gridRadios1">
                        Male
                      </label>
                    </div>
                    <div class="form-check form-switch">
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
                <div class = "col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editGuardian" placeholder="Guardian Name">
                    <label for="editGuardian">Guardian Name</label>
                  </div>
                </div>
                <div class = "col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="editGuardianContact" placeholder="Guardian Contact">
                    <label for="editGuardianContact">Guardian Contact</label>
                  </div>
                </div>

         
                    <div class="text-center">

                      <button class="btn btn-primary" type="button" disabled id ="btnIsUpdatingEdit" hidden>
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Updating...
                      </button><!--End of updating button-->
                      <button class="btn btn btn-danger" type="button" disabled id ="btnEditError" hidden>
                      <i class="bi bi-exclamation-octagon"></i>
                      Error!
                      </button><!-- End of error button -->
                      
                      <button type="button" class="btn btn-success" id ="btnEditUsers" onClick ="checkEditFields()">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-grades">

                  <!-- Floating Labels Form -->
              <form class="row g-3 needs-validation" id ="frmGradesStudents">
              
              <input type="hidden" id="gradesId">
                 
              <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" disabled class="form-control" id="gradesStudentNum" placeholder="Student Number" required>
                    <label for="gradesStudentNum">Student Number</label>
                  </div>
                </div>
               <div class ="col-md-6">
               <div class="form-floating">
                    <input type="text"  class="form-control" id="gradesSemester" placeholder="Semester" required>
                    <label for="gradesSemester">Semester</label>
                  </div>
               </div> 
               <div class="col-md-4">
                <div class="form-floating mb-3">
                      <select class="form-select" onchange="insertSubjects(this.value)" id="gradeSubject" aria-label="Floating label select example">

                      </select>
                      <label for="gradeSubject">Subjects</label>
                    </div>
                </div>
                <div class ="col-md-4">
                 <div class="form-floating">
                    <input type="number"  class="form-control" id="gradesMarks" placeholder="Marks" required>
                    <label for="gradesMarks">Marks</label>
                 </div>
               </div> 
               <div class ="col-md-4">
                 <div class="form-floating">
                    <input type="text"  class="form-control" id="gradesInstructor" placeholder="Instructor" required>
                    <label for="gradesInstructor">Instructor</label>
                 </div>
               </div> 
               <div class ="col-md-6">
                 <div class="form-floating">
                    <input type="text"  class="form-control" id="gradesSchedule" placeholder="Schedule" required>
                    <label for="gradesSchedule">Schedule</label>
                 </div>
               </div>
              
               <div class ="col-md-6">
               <button class="btn btn-primary" type="button" disabled id ="btnIsUpdatingGrades" hidden>
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Updating...
                </button><!--End of updating button-->
               <button type ="button" class="btn btn-success" type="submit" onClick ="checkGradeFields()" id ="btnAddGrade">Add Subject</button>
               <a href ="archived-results.php" class="btn btn-warning" >
              <i class="bi bi-recycle"></i> 
              </a>
               </div>
              
            <div id="table-wrapper">
             <div id="table-scroll">
               <table class="table table-hover"  id ="tblGrades">
                <thead>
                  <tr class="table-primary">
                    <th scope="col" class ="header-title">SUBJECT NAME</th>
                    <th scope="col" class ="header-title">GRADE</th>
                    <th scope="col" class ="header-title">INSTRUCTOR</th>
                    <th scope="col" class ="header-title">SCHEDULE</th>
                    <th scope="col" class ="header-title">DATE CREATED</th>
                    <th scope="col" class="table-info" id ="th-action">ACTIONS</th>
                  </tr>
                </thead>
                <tbody id ="tbody-student-subject">
                 
                </tbody>
              </table>
             </div>
            </div>  

               </form><!-- End floating Labels Form -->
                </div>

                <div class="tab-pane fade pt-3" id="profile-bills">  <!-- Change Bills Form -->
                    <!-- Floating Labels Form -->
              <form class="row g-3 needs-validation" id ="frmfeeStudents">
              
              <input type="hidden" id="feeId">
                 
              <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" disabled class="form-control" id="feeStudentNum" placeholder="Student Number" required>
                    <label for="feeStudentNum">Student Number</label>
                  </div>
                </div>
               <div class ="col-md-6">
               <div class="form-floating">
                    <input type="text"  class="form-control" id="feeSemester" placeholder="Semester" required>
                    <label for="feeSemester">Semester</label>
                  </div>
               </div> 
               <div class="col-md-6">
                <div class="form-floating mbz-3">
                      <select class="form-select" onchange="insertFee(this.value)" id="feeMiscellaneous" aria-label="Floating label select example">

                      </select>
                      <label for="feeMiscellaneous">Miscellaneous Fee</label>
                    </div>
                </div>

               <div class ="col-md-6">
               <button class="btn btn-primary" type="button" disabled id = "btnIsUpdatingFee" hidden>
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Updating...
                </button><!--End of updating button-->
               <button type ="button" class="btn btn-success" id ="btnAddMisc" type="submit" onClick ="checkFeeFields()">Add Miscellaneous Fee</button>
               </div>
              <hr>
              <div class ="col-md-4">
                <div class="form-floating">
                   <input type="number"  class="form-control" id="feeBalance" placeholder="Balance" disabled>
                  <label for="feeBalance">Balance</label>
                </div>
              </div>
              <div class ="col-md-4">
                <div class="form-floating">
                   <input type="number"  class="form-control" id="feePayment" placeholder="Payment">
                  <label for="feePayment">Payment</label>
                </div>
              </div>
              <div class ="col-md-4">
              <button class="btn btn-primary" type="button" disabled id = "btnIsUpdatingPayment" hidden>
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Updating...
                </button><!--End of updating button-->
              <button type ="button" class="btn btn-success" type="submit"  id ="btnPaymentClick"onClick ="checkPayment()">Add Payment</button>
              </div>
            <div  class="table-wrapper">
             <div  class ="table-scroll">
               <table class="table table-hover"  id ="tblFee">
                <thead >
                  <tr class="table-primary">
                  <th scope="col" class ="header-title">TYPE</th>
                    <th scope="col" class ="header-title">NAME</th>
                    <th scope="col" class ="header-title">AMOUNT</th>
                    <th scope="col" class ="header-title">DATE CREATED</th>
                    <th scope="col" class="table-info" id ="th-action">ACTIONS</th>
                  </tr>
                </thead>
                <tbody id ="tbody-student-fee">
                 
                </tbody>
              </table>
             </div>
            </div>  

               </form><!-- End floating Labels Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>


<!-- End of View Student Info -->

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
<script src ="../js/student-accounts.js?t=1491313943549"  type = "text/javascript"></script>
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