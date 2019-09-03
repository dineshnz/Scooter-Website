<?php

require '../config/db.php';

session_start();

?>

<?php 
    
        $historyId = $_POST['historyId'];
        $requestToId= $_POST['requestFromId'];

        $message ='your request to view profile has been accepted';
        $passportNoOwner= $_SESSION['passport'];
        $username = $_SESSION['username'];//logged in person

    $acceptQuery = "UPDATE profilerequest SET result= 'approved' WHERE  result='pending' AND userHistoryId=? AND requestFromId=?";
    $stmt = $conn->prepare($acceptQuery);
    $stmt->bind_param('ii', $historyId, $requestToId);
   if($stmt->execute()){
       echo "Request approved";
       $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
       VALUES ($requestToId,'acceptedProfile','$message', 'unread', '$passportNoOwner','$username',CURRENT_TIMESTAMP)";
      
      $result = $conn->query($sql);

      
   }else{
       echo "failed update";
   }
    
   
   


?>

