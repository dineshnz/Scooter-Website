<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['passport'])) {
  $_SESSION['msg'] = "You must log in first";
  $_SESSION['type'] = 'alert-danger';
  header('location: ../login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['passport']);
  header("location: login.php");
}


require '../config/db.php';

?>

<?php 


$requesterId= $_POST['requestFromId'];
$requesteeId = $_SESSION['id'];
$message ='your request to view profile has been rejected';
$passportNoOwner= $_SESSION['passport'];
        $username = $_SESSION['username'];//logged in person
        //querying profile request table and updating rows
        $acceptQuery = "UPDATE profilerequest SET result= 'rejected' WHERE  result='pending' AND requesteeId=? AND requestFromId =?";
        $stmt = $conn->prepare($acceptQuery);
        $stmt->bind_param('ii', $requesteeId, $requesterId);
        if($stmt->execute()){
         echo "Request Rejected";
         //sending data to the notifications table to update the notification
         $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
         VALUES ($requesterId,'acceptedProfile','$message', 'unread', '$passportNoOwner','$username',CURRENT_TIMESTAMP)";
         
         $result = $conn->query($sql);

         
       }else{
         echo "failed update";
       }
       
       
       


       ?>

