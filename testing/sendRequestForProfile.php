<?php
    session_start();
    require 'config/db.php';
    
    
     $historyId= $_POST['historyId'];
    $requesteeId = $_POST['userId'];
     $requestFromId = $_SESSION['id'];//current logged in user will be the one to send the request
     $fullname =$_SESSION['username'];
    
    $request ="pending";
    $message = "would like to view your history of renting";
    $userPassport=$_SESSION['passport'];

    $historyQuery = "SELECT * FROM profilerequest WHERE requesteeId=? AND userHistoryId=? LIMIT 1";
    $stmt = $conn->prepare($historyQuery);
    $stmt->bind_param('ii', $requesteeId, $historyId);
    $stmt->execute();
    $result = $stmt->get_result();
    $passportCount = $result->num_rows;
   
    
    $stmt->close();

    if ($passportCount > 0) {
       echo "You have already requested for approval. Please wait until the user approves your request.";
       while($row = $result->fetch_assoc()){
           $_SESSION['vehicleResult'] = $row['result'];
       }

      
    }
    else{
   

    $sql = "INSERT INTO profilerequest (requestFromId, requesterFullname, message,
     requesteeId, result, userHistoryId)
     VALUES (?, ?, ?, ?, ?,?)";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issisi', $requestFromId, $fullname, $message, $requesteeId, $request, $historyId);
    $resultSql = $stmt->execute();

    if($resultSql){
        $sql = "SELECT * FROM userhistory WHERE historyId=?";
        //$sql = "SELECT * FROM tblscooters t join users u on u.id = t.userId WHERE u.passport=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $historyId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->num_rows;
        $stmt->close();

    if($row > 0)
    {
     
       echo "Request Sent!! Please wait for owner's approval"; 
       $sql = "INSERT INTO `notifications`( `requesterId`, `type`, `message`, `status`, `notifierPassport`, `notifierName`, `date`) 
       VALUES ($requesteeId,'viewProfile','$message', 'unread', '$userPassport','$fullname',CURRENT_TIMESTAMP)";
      
      $result = $conn->query($sql);
         }
    else{
        echo "Error";
    }

}

    }


?>