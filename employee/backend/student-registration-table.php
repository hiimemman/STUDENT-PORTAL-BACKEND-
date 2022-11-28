<?php
try{
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    include_once("../connections/connection.php");
$con = connection();

$sql = mysqli_query($con, "SELECT 
* FROM `tbl_studentregistration`  ORDER BY `added_at` DESC");

//store in result

$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

exit(json_encode($result));
}catch (Exception $e){
    exit(json_encode(array("statusCode"=>$e->getMessage())));
}

?>