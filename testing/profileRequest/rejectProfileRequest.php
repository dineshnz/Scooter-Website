<?php

require '../config/db.php';

session_start();

?>

<?php 
    
       
         $requesterId= $_POST['requestFromId'];
         $requesteeId = $_SESSION['id'];
        $message ='your request to view profile has been rejected';
        $passportNoOwner= $_SESSION['passport'];
        $username = $_SESSION['username'];//logged in person

    $acceptQuery = "UPDATE profilerequest SET result= 'rejected' WHERE  result='pending' AND requesteeId=? AND requestFromId =?";
    $stmt = $conn->prepare($acceptQuery);
    $stmt->bind_param('ii', $requesteeId, $requesterId);
   if($stmt->execute()){
       echo "Request approved";
       $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
       VALUES ($requesteeId,'acceptedProfile','$message', 'unread', '$passportNoOwner','$username',CURRENT_TIMESTAMP)";
      
      $result = $conn->query($sql);

      
   }else{
       echo "failed update";
   }
    
   
   


?>

