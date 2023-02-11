<?php 
    session_start();
    unset($_SESSION['LOGIN_NAME']);
    header('location:scroll.php');
    die();
?>