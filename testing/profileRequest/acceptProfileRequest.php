<?php
session_start();
error_reporting(0);
//if user is not logged in, redirect user to login page with error.
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
$message ='your request to view profile has been accepted';
$passportNoOwner= $_SESSION['passport'];
        $username = $_SESSION['username'];//logged in person
        //querying profileRequest table to retrieve data and update that row. 
        $acceptQuery = "UPDATE profilerequest SET result= 'approved' WHERE  result='pending' AND requesteeId=? AND requestFromId =?";
        $stmt = $conn->prepare($acceptQuery);
        $stmt->bind_param('ii', $requesteeId, $requesterId);
        if($stmt->execute()){
         echo "Request approved";
         //once the requst is approved, then send the information on notification table 
         $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, 
         `notifierPassport`, `notifierName`, `date`) 
         VALUES ($requesterId,'acceptedProfile','$message', 'unread', 
         '$passportNoOwner','$username',CURRENT_TIMESTAMP)";

         $result = $conn->query($sql);


       }else{
         echo "failed update";
       }

       ?>

