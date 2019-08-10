<?php

require 'config/db.php';

session_start();

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

