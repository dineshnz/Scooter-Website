<?php

require 'config/db.php';

session_start();

?>

<?php 
    
        $vehicleId = $_POST['vehicleId'];
        $userId= $_POST['userId'];

        echo $vehicleId;
 

   
    $nameQuery = "UPDATE requests SET result= 'rejected' WHERE  result='pending' AND vehicleId=?";
    $stmt = $conn->prepare($nameQuery);
    $stmt->bind_param('i', $vehicleId);
   if($stmt->execute()){
       echo "Request rejected";
   }else{
       echo "failed update";
   }
    
   
   


?>

