<?php
    session_start();
 
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){
    if($_SESSION['user_type']=='restaurent'){
        header("location: dashboard.php");
    }
} 

?>