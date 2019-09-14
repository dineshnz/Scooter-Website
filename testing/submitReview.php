<!-- controller to provide review from owner to user. -->
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
//if the user level is less than 2 then user will not be able to visit this page
if (($_SESSION['userLevel']) !=2) {
	$_SESSION['msg'] = "You are not allowed to visit url you entered";
	$_SESSION['type'] = 'alert-danger';
	header('location: userProfile.php');
}
require 'config/db.php';

//on submit button clicked, get all the message (havent implemented yet)

$paidToId = $_POST['ownerId'];
$ownerResponse = $_POST['message'];
$vehicleId = $_POST['vehicleId'];
    //   select the tblscooter and transaction table to view vehicle brought column and userId (renterId) column

$sql ="SELECT * FROM tblscooters s JOIN transactions t ON t.vehicleId = s.vid WHERE t.paidToId =? AND vehicleID =?";
$query = $conn -> prepare($sql);
$query->bind_Param('ii', $paidToId, $vehicleId);
$query->execute();
$results=$query->get_result();
$count = $results->num_rows;
if($count > 0){
  while($row = $results->fetch_assoc()){
      
    $userId = $row['paidById'];

            //lets check if the owner has already provided review
    $sql = "SELECT historyId FROM userhistory WHERE userId=? AND ownerId=? AND vehicleId =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $userId, $paidToId, $vehicleId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->num_rows;
    $stmt->close();

            //if the row is greater than 0 that means owner has provided the review
    if($row > 0){
        echo "You have already reviewed this user";
    }
    else{

        


        $sql = "INSERT INTO userhistory(ownerResponse, userId, ownerId, vehicleId)
        VALUES (?, ?, ?, ?)";
        $query1 = $conn->prepare($sql);

        $query1-> bind_param('siii',$ownerResponse, $userId, $paidToId, $vehicleId);
        $result = $query1->execute();
        
        if($result){
         
         echo "Review Posted successfully";
         

     }else{
         echo "You have already posted a review";
     }
 }
} 
}
else{
    echo "The vehicle is not rented by anyone";
}


?>