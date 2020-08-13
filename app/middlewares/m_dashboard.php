<?php
    session_start();
    if($_SESSION['user_type']=='customer'){
        header("location: index.php");
    }
?>