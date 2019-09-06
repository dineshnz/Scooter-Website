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
?>
<html>
<head>
    <title>My Profile Update Process</title>
</head>
<body>
   <?php
    //require the database connecting information
   require 'config/db.php';

    //retrieving all the data from myProfileUpdate.js and passing into different variables for storage
   $id=$_POST['id'];
   $fullname=$_POST['fullname'];
   $email=$_POST['email'];
   $address=$_POST['address'];
   $passport=$_POST['passport'];
   $driverLicense=$_POST['driverLicense'];
   
    //checking if there are any columns remain empty. If all column have been full out, it will pass the data to the database
   if(empty($fullname))
   {
    echo"Please enter your full name!";
}
else if(empty($email))
{
    echo"Please enter your email address!";
}
else if(empty($passport))
{
    echo"Please enter your passport number!";
}
else if(empty($driverLicense))
{
    echo"Please enter your driver license!";
}
else
{
    $updateQuery="UPDATE users SET fullname='$fullname' , email='$email', address='$address', passport='$passport', driverLicense='$driverLicense' WHERE id='$id'";
    $result=@mysqli_query($conn,$updateQuery) Or die("<p>Data insertion failure</p>, Error: ".mysqli_errno($conn)." ".mysqli_error($conn));
    echo"Personal Profile Update Successfully!";
}

?>
</body>
</html>