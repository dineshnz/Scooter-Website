<?php

require 'config/db.php';

session_start();

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

    
        $vehicleId = $_POST['vehicleId'];
        $requesterId= $_POST['requesterId'];
        $message ='your request has been approved';
        $passportNoOwner= $_SESSION['passport'];
        $fullnameOwner = $_SESSION['username'];

       
    $nameQuery = "UPDATE requests SET result= 'approved' WHERE  result='pending' AND vehicleId=? AND requesterId=?";
    $stmt = $conn->prepare($nameQuery);
    $stmt->bind_param('ii', $vehicleId, $requesterId);
   if($stmt->execute()){
       echo "Request approved";
            $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
            VALUES ($requesterId,'approved','$message', 'unread', '$passportNoOwner','$fullnameOwner',CURRENT_TIMESTAMP)";
           
           $result = $conn->query($sql);  
    
   }else{
       echo "failed update";
   }
    
   
   


?>

