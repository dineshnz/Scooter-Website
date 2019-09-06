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
    <title>Change My Password</title>
</head>

<body>
   <?php
    //require the database connecting information
   require 'config/db.php';
    //require_once 'controllers/authController.php';

    //retrieving all the data from myProfileUpdate.js and passing into different variables for storage
   $id=$_POST['id'];
   $currentPassword=$_POST['currentPassword'];
   $newPassword=$_POST['newPassword'];
   $confirmPassword=$_POST['confirmPassword'];

    //conditions for checking if user has entered the current password, new password and confirm the new password, error messages will be displayed if criteria don't meet
   if(empty($currentPassword))
   {
    echo "Please enter your current password!";
}
else if(empty($newPassword))
{
    echo "Please enter a new password!";
}
else if(empty($confirmPassword))
{
    echo "Please confirm your password with the new password!";
}
else if($currentPassword == $newPassword)
{
    echo "You cannot use the change your password with the same password!";
}
else if($confirmPassword != $newPassword)
{
    echo "Your confirm password does not match with your new password!";
}
else
{
        //query to search for the password stored in the database using the primary key "id" and store it to a variable after query execution
    $sqlquery="SELECT * FROM users WHERE id='$id'";
    $result=@mysqli_query($conn,$sqlquery) Or die("SQL query failure! Error: ".mysqli_errno($conn)." ".mysqli_error($conn));
    $row=@mysqli_fetch_assoc($result);
    $dbpassword=$row['password'];
    
        //verifying if current password entered matches with the password stored in the database
    if(password_verify($currentPassword, $dbpassword))
    {
            //if both passwords match, encrypt the new password and update it to the database
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT); //encrypt password
            $sqlquery="UPDATE users SET password='$newPassword' WHERE id='$id'";
            $result=@mysqli_query($conn,$sqlquery) Or die("<p>Update new password failure, Error: ".mysqli_errno($conn)." ".mysqli_error($conn));
            echo "Your new password has been updated!";
            
        }
        else
        {
            //if passwords don't match, print an error message
            echo "The password you have entered does not match!";
        }
    }
    ?>
</body>
</html>