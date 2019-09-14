<!-- this page basically sends request to the owner to view the selecte scooter. -->
<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['passport'])) {
    $_SESSION['msg'] = "You must log in first";
    $_SESSION['type'] = 'alert-danger';
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['passport']);
    header("location: login.php");
}
require 'config/db.php';


$vhid= $_POST['vhid'];
$ownerId = $_POST['ownerId'];
$username = $_SESSION['username'];
$requesterId = $_SESSION['id'];
$vehicleTitle =  $_POST['vehicleTitle'];
$vehicleBrand =  $_POST['vehicleBrand'];

$request ="pending";
$message = "would like to view your scooter detail";
$userPassport=$_SESSION['passport'];

//read the data from request table and if the request is already sent then display the message
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
    //if there is no request sent then send new request to the owner 
    $sql = "INSERT INTO requests (fullname, message, vehicleId, vehicleTitle, vehicleBrand,result, requesterId, ownerId)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisssii', $username, $message, $vhid, $vehicleTitle, $vehicleBrand, $request, $requesterId, $ownerId);
    
    $resultSql = $stmt->execute();

    if($resultSql){
        $sql = "SELECT * FROM tblscooters WHERE vid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $vhid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->num_rows;
        $stmt->close();

        if($row > 0)
        {
           
         echo "Request Sent!! Please wait for owner's approval"; 
         //if the request is sent then update the notification table with the particular request
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