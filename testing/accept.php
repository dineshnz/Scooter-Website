<?php

require 'config/db.php';

session_start();

?>

<?php 
    
        $vehicleId = $_POST['vehicleId'];
        $requesterId= $_POST['requesterId'];
       
    $nameQuery = "UPDATE requests SET result= 'approved' WHERE  result='pending' AND vehicleId=? AND requesterId=?";
    $stmt = $conn->prepare($nameQuery);
    $stmt->bind_param('ii', $vehicleId, $requesterId);
   if($stmt->execute()){
       echo "Request approved";
   }else{
       echo "failed update";
   }
    
   
   


?>

