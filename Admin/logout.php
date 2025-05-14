<?php
session_start();          
session_unset();         
session_destroy();  
session_start();
$_SESSION['logout_msg'] = "You have logged out successfully.";     
header("Location: ../admin/index.php");  
exit;

 
 