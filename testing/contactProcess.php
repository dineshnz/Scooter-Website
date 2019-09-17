<?php 
/*session_start();
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
}*/
?>
<html>
<head>
    <title>Contact Information</title>
</head>
<body>
   <?php
    //require the database connecting information
    require 'config/db.php';

    //retrieving all the data from myProfileUpdate.js and passing into different variables for storage
    $username=$_POST['username'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $driverLicense=$_POST['driverLicense'];
    $passport=$_POST['passport'];
    $message=$_POST['message'];

    //get the biggest value for id in the database and store it into $retriveID variable
    $retrieveQuery="SELECT MAX(id) AS 'max' FROM contact_users";
    $result=@mysqli_query($conn,$retrieveQuery) Or die("<p>Data retrival failure</p>, Error: ".mysqli_errno($conn)." ".mysqli_error($conn));
    $row=mysqli_fetch_array($result);
    $retriveID=$row['max'];

    //checking if $retriveID is null due to no data in the database or else increment by 1
    if($retriveID == null)
    {
        $retriveID = 1;
    }
    else
    {
        $retriveID++;
    }
   
    //checking if there are any columns remain empty. If all column have been full out, it will pass the data to the database
    if(empty($username))
    {
        echo"<p>Please enter your username!</p>";
    }
    else if(empty($email))
    {
        echo"<p>Please enter your email address!</p>";
    }
    else if(empty($subject))
    {
        echo"<p>Please enter a subject for this message!</p>";
    }
    else if(empty($passport))
    {
        echo"<p>Please enter your passport number!</p>";
    }
    else if(empty($driverLicense))
    {
        echo"<p>Please enter your driver license!</p>";
    }
    else if(empty($message))
    {
        echo"<p>Please enter a message for the team to review your query!</p>";
    }
    else
    {
        $insertQuery="INSERT INTO contact_users (id, username, email, subject, driverLicense, passport, message) VALUES ('$retriveID', '$username', '$email', '$subject', '$driverLicense', '$passport', '$message')";
        $result=@mysqli_query($conn,$insertQuery) Or die("<p>Data insertion failure</p>, Error: ".mysqli_errno($conn)." ".mysqli_error($conn));
        echo"<p>Thank you for contacting us. The support team will contact you as soon as possible!</p>";
    }
?>
</body>
</html>