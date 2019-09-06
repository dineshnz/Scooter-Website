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

require 'config/db.php';

?>

<?php 

$vehicleId = $_POST['vehicleId'];
$requesterId= $_POST['requesterId'];

$message ='your request has been rejected';
$passportNoOwner= $_SESSION['passport'];
$fullnameOwner = $_SESSION['username'];




$nameQuery = "UPDATE requests SET result= 'rejected' WHERE  result='pending' AND vehicleId=? AND requesterId=?";
$stmt = $conn->prepare($nameQuery);
$stmt->bind_param('ii', $vehicleId, $requesterId);
if($stmt->execute()){
 echo "Request rejected";
 $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
 VALUES ($requesterId,'rejected','$message', 'unread', '$passportNoOwner','$fullnameOwner',CURRENT_TIMESTAMP)";
 
 $result = $conn->query($sql);

 
}else{
 echo "failed update";
}





?>

