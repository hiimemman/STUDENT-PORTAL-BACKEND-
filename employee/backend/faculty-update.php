<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include_once("../connections/connection.php");
$con = connection();

$CurrentId  = $_POST['ID'];
$Faculty = $_POST['Faculty'];
$Description = $_POST['Description'];
$Status = $_POST['Status'];
$Action = $_POST['Action'];
$EditorPosition = $_POST['EditorPosition'];
$EditorEmail = $_POST['EditorEmail'];
$Category = $_POST['Category'];

try{
    
    if (isset($CurrentId)) {

        $beforeSql = "SELECT * FROM tbl_faculty WHERE `faculty_name` = '$Faculty';";     
       
        mysqli_query($con, $beforeSql);

        $getBefore = $con ->query($beforeSql) or die ($con->error);
        $setBefore =  $getBefore ->fetch_assoc();
        $rowBefore = json_encode($setBefore);

        $sql = "UPDATE `tbl_faculty` SET `faculty_name` = '$Faculty',`description` = '$Description',`status` = '$Status' WHERE `tbl_faculty`.`faculty_name` = '$Faculty';";
        mysqli_query($con, $sql);
       
        $AfterSql = "SELECT * FROM tbl_faculty WHERE `faculty_name` = '$Faculty';";     
                
        mysqli_query($con, $AfterSql);

        $getAfter = $con ->query($AfterSql) or die ($con->error);
        $rowAfter = json_encode($getAfter ->fetch_assoc());
        

        $auditsql = "INSERT INTO `tbl_history` (`action`,`category`,`editor_position`,`editor_email`,`edited_email`,`after_edit`,`before_edit`) VALUES ('$Action','$Category','$EditorPosition','$EditorEmail', '$Faculty', '$rowAfter','$rowBefore');";
                  mysqli_query($con, $auditsql);

                  $xsql = "SELECT * from `tbl_faculty` WHERE `faculty_name` =  '$Faculty'";
        mysqli_query($con, $xsql);

        $user = $con ->query($xsql) or die ($con->error);
        $row = $user->fetch_assoc();
        exit(json_encode(array("statusCode"=>$row)));
    }
}catch(Exception $e){
    exit(json_encode(array("statusCode"=>$e->getMessage())));
}



?>