<?php
session_start();

if (!isset($_SESSION['passport'])) {
    $_SESSION['msg'] = "You must log in first";
    $_SESSION['type'] = 'alert-danger';
	header('location: login.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['passport']);
	header("location: login.php");
}
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