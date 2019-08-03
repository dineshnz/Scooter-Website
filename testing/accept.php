<?php

require 'config/db.php';

session_start();

?>

<?php 
    if(isset($_POST['acceptBtn'])){
        $vehicleId = $_POST['vid'];
        $userId= $_POST['requesterId'];
 

   
    $nameQuery = "UPDATE requests SET result= 'approved' WHERE  result='pending' AND vehicleId=?";
    $stmt = $conn->prepare($nameQuery);
    $stmt->bind_param('i', $vehicleId);
   if($stmt->execute()){
       echo "successful";
   }else{
       echo "failed update";
   }
    
   
   
}

?>