<?php

session_start();
error_reporting(0);
//redirecting user to login page if user is not logged in
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


require 'config/db.php';
?>

<?php 

$vehicleId = $_POST['vehicleId'];
$requesterId= $_POST['requesterId'];
$message ='your request has been approved';
$passportNoOwner= $_SESSION['passport'];
$fullnameOwner = $_SESSION['username'];

//querying the request page to see the pending vehicle requests and update the request to approved.
$nameQuery = "UPDATE requests SET result= 'approved' WHERE  result='pending' AND vehicleId=? AND requesterId=?";
$stmt = $conn->prepare($nameQuery);
$stmt->bind_param('ii', $vehicleId, $requesterId);
if($stmt->execute()){
 echo "Request approved";
 //once the request is approved, populate notification table with the latest update on the request. 
 $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
 VALUES ($requesterId,'approved','$message', 'unread', '$passportNoOwner','$fullnameOwner',CURRENT_TIMESTAMP)";

 $result = $conn->query($sql);  

}else{
 echo "failed update";
}





?>

