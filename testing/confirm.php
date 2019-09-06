<?php
session_start();
error_reporting(0);
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
 require_once 'controllers/authController.php';
    if(!isset($_GET['token'])){
        header('location: signup.php');
    }
    else{
        $token = $_GET['token'];
        verifyUser($token);
        header('location: signup.php');
    }

    if(!isset($_GET['password-token'])){
        header('location: forgot_password.php');
    }
    else{
        $passwordToken = $_GET['password-token'];
        resetPassword($passwordToken);
       
    }
?>