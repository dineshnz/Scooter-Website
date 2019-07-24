<?php
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