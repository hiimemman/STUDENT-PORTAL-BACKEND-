<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once("../connections/connection.php");
$con = connection();


$editPosition = $_POST['EditorPosition'];
$editEmail = $_POST['EditorEmail'];
$category =  $_POST['Category'];
$action = $_POST['Action'];
$Subject_Code = $_POST['Subject_Code'];
$Subject_Name = $_POST['Subject_Name'];
$Amount = $_POST['Amount'];
$Units = $_POST['Units'];
try{
    


    $sql = "INSERT INTO `tbl_subject` (`subject_code`,`subject_name`,`amount`,`units`) VALUES ('$Subject_Code','$Subject_Name','$Amount','$Units');";
    mysqli_query($con, $sql);


    $BeforeSql = "SELECT `subject_code`,`subject_name`,`amount`,`units`,`status`,`added_at` FROM tbl_subject WHERE subject_code = '$Subject_Code'";     
                
    mysqli_query($con, $BeforeSql);

    $getBefore = $con ->query($BeforeSql) or die ($con->error);
    $rowBefore = json_encode($getBefore ->fetch_assoc());


    

    $auditsql = "INSERT INTO `tbl_updatehistory` (`action`,`category`,`editor_position`,`editor_email`,`edited_email`,`before_edit`) VALUES ('$action','$category','$editPosition','$editEmail', '$Email', '$rowBefore' );";
    mysqli_query($con, $auditsql);

    exit(json_encode(array("statusCode"=>200)));

  
}catch(Exception $e){
    exit(json_encode(array("statusCode"=>$e->getMessage())));
}


?>