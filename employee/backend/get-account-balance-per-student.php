<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-type: application/json');

 try{
    include_once("../connections/connection.php");
$con = connection();

$StudentID = $_POST['StudentId'];


    $sql = mysqli_query($con,"SELECT * FROM `tbl_accountbalance` WHERE `tbl_accountbalance`.`studentnumber` = '$StudentID' ;");

    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
   

    exit(json_encode(array("statusCode"=>200, "content" => $result)));
 }catch(Exception $e){
    exit(json_encode(array("statusCode" =>201, "error"=>$e->getMessage())));
 }

 ?>