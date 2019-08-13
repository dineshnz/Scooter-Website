<?php

require '../config/db.php';

session_start();

?>

<?php 
    
        $historyId = $_POST['historyId'];
        $requestToId= $_POST['requestFromId'];

        $message ='your request to view profile has been rejected';
        $passportNoOwner= $_SESSION['passport'];
        $username = $_SESSION['username'];//logged in person


 

   
    $rejectQuery = "UPDATE profilerequest SET result= 'rejected' WHERE  result='pending' AND userHistoryId=? AND requestFromId=?";
    $stmt = $conn->prepare($rejectQuery);
    $stmt->bind_param('ii', $historyId, $requestToId);
   if($stmt->execute()){
       echo "Request rejected";
       $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
       VALUES ($requestToId,'rejectedProfile','$message', 'unread', '$passportNoOwner','$username',CURRENT_TIMESTAMP)";
      
      $result = $conn->query($sql);

      
   }else{
       echo "failed update";
   }
    
   
   


?>

