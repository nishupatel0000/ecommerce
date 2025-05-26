<?php
$id = $_POST['id'];
 
require_once '../common/config.php';  
$select = "SELECT * FROM user where id='$id'";
$result = mysqli_query($con_query, $select);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);



?>