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

    //after the update, select the data from the database to update the session variables to new value
    $sql = "SELECT * FROM users WHERE id=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
       
        $stmt->close();
        $_SESSION['username'] = $user['fullname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['address'] = $user['address'];
        

}

?>
</body>
</html>