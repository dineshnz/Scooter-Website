<?php
    session_start();
    require 'config/db.php';
    
    
    $vhid= $_POST['vhid'];
    $username = $_SESSION['username'];
    $requesterId = $_SESSION['id'];
    $request ="pending";
    $message = "would like to view your scooter detail";

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
   

    $sql = "INSERT INTO requests (fullname, message, vehicleId, result, requesterId)
     VALUES (?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisi', $username, $message, $vhid, $request, $requesterId);

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
    while($row = $result->fetch_assoc())
    {  
       echo "Request Sent!! Please wait for owner's approval"; 
         }
        }
    else{
        echo "Error";
    }

}

    }


?>