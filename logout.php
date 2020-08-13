<?php
//Unset session and destroy
session_start();
$_SESSION = array();
$_SESSION['loggedin']=false;
unset($_SESSION['loggedin']);
session_destroy();
print_r($_SESSION);
header("location: index.php");

?>
