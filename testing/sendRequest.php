<?php
    session_start();
    require 'config/db.php';
    
    
    $vhid= $_POST['vhid'];
    $ownerId = $_POST['ownerId'];
    $username = $_SESSION['username'];
    $requesterId = $_SESSION['id'];
    $request ="pending";
    $message = "would like to view your scooter detail";
    $userPassport=$_SESSION['passport'];

    $nameQuery = "SELECT * FROM requests WHERE requesterId=? AND vehicleId=? LIMIT 1";
    $stmt = $conn->prepare($nameQuery);
    $stmt->bind_param('ii', $requesterId, $vhid);
    $stmt->execute();
    $result = $stmt->get_result();
    $passportCount = $result->num_rows;
   
    
    $stmt->close();

    if ($passportCount > 0) {
       echo "You have already requested for approval. Please wait until the owner approves your request.";
       while($row = $result->fetch_assoc()){
           $_SESSION['vehicleResult'] = $row['result'];
       }

      
    }
    else{
   

    $sql = "INSERT INTO requests (fullname, message, vehicleId, result, requesterId, ownerId)
     VALUES (?, ?, ?, ?, ?,?)";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisii', $username, $message, $vhid, $request, $requesterId, $ownerId);

    $resultSql = $stmt->execute();

    if($resultSql){
        $sql = "SELECT * FROM tblscooters WHERE vid=?";
        //$sql = "SELECT * FROM tblscooters t join users u on u.id = t.userId WHERE u.passport=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $vhid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->num_rows;
        $stmt->close();

    if($row > 0)
    {
     
       echo "Request Sent!! Please wait for owner's approval"; 
       $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
       VALUES ($ownerId,'pending','$message', 'unread', '$userPassport','$username',CURRENT_TIMESTAMP)";
      
      $result = $conn->query($sql);
         }
    else{
        echo "Error";
    }

}

    }


?>