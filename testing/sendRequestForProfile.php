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


    
    $requesteeId = $_POST['userId'];
     $requestFromId = $_SESSION['id'];//current logged in user will be the one to send the request
     $fullname =$_SESSION['username'];
     
     $request ="pending";
     $message = "would like to view your history of renting";
     $userPassport=$_SESSION['passport'];

     $historyQuery = "SELECT * FROM profilerequest WHERE requesteeId=? AND requestFromId=?";
     $stmt = $conn->prepare($historyQuery);
     $stmt->bind_param('ii', $requesteeId, $requestFromId);
     $stmt->execute();
     $result = $stmt->get_result();
     $passportCount = $result->num_rows;
     
     
     $stmt->close();

     if ($passportCount > 0) {
       echo "You have already requested for approval. Please wait until the user approves your request.";
       while($row = $result->fetch_assoc()){
         $_SESSION['vehicleResult'] = $row['result'];
       }

       
     }
     else{
       

      $sql = "INSERT INTO profilerequest (requestFromId, requesterFullname, message,
      requesteeId, result)
      VALUES (?, ?, ?, ?, ?)";


      $stmt = $conn->prepare($sql);
      $stmt->bind_param('issis', $requestFromId, $fullname, $message, $requesteeId, $request);
      $resultSql = $stmt->execute();

      if($resultSql){
       
       
       echo "Request Sent!! Please wait for owner's approval"; 
       $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
       VALUES ($requesteeId,'viewProfile','$message', 'unread', '$userPassport','$fullname',CURRENT_TIMESTAMP)";
       
       $result = $conn->query($sql);
     }
     else{
      echo "Error";
    }

  }

  


  ?>