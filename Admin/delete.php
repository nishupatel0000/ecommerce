<?php
session_start();
require_once '../common/config.php';
$id=$_POST['id'];
 
$delete = "DELETE FROM user WHERE id='$id'";
$result = mysqli_query($con_query, $delete);

if($result){
    header("location:user_info.php");
    
}else{
    echo "Error deleting record: " . mysqli_error($con_query);
}




?>