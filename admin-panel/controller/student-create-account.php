<?php
include_once("../connections/connection.php");
$con = connection();

$StudNum = $_POST['StudentNumber'];
$Fname = $_POST['Fname'];
$Mname = $_POST['Mname'];
$Lname = $_POST['Lname'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$Birthday = $_POST['Birthday'];
$Sex = $_POST['Sex'];
$Course = $_POST['Course'];
$Section = $_POST['Section'];
$Contact = $_POST['Contact'];
$Address = $_POST['Address'];
$Guardian = $_POST['Guardian'];
$GuardianContact = $_POST['GuardianNum'];
if(isset($Fname)){

try{
    $sql = "INSERT INTO `tbl_studentinfo` (`profile_url`, `studentnumber`, `firstname`, `middlename`, `lastname`, `email`, `address`, `password`, `sex`, `course`, `section`, `birthday`, `contact`, `guardian`, `guardian_contact`) VALUES ('default_profile.jpg', '$StudNum', '$Fname', '$Mname', '$Lname', '$Email', '$Address', '$Password', '$Sex', '$Course', '$Section', '$Birthday', '$Contact', '$Guardian', '$GuardianContact');";
    mysqli_query($con, $sql);
    exit(json_encode(array("statusCode"=>200)));
}catch(Exception $e){
    exit(json_encode(array("statusCode"=>$e->getMessage())));
}
}
// $getFiles = $_POST['floatingFname'];
// if(isset($getFiles)){
//     exit(json_encode(array("statusCode"=>201)));
// }

?>