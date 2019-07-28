<?php
session_start();
//logout user
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['fullname']);
    unset($_SESSION['passport']);
    unset($_SESSION['address']);
    unset($_SESSION['driverLicense']);
    header('location: login.php');
    exit();
}

?>