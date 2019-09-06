<!-- <script src="js/showScooters.js"></script> -->

<?php
require 'config/db.php';
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


    // if(isset($_POST['readrecords'])){
$ownerId = $_SESSION['id'];


      //checking if the current logged in person has any listing if there is no listing to this
      //owner then this will print that the user does not have any listing yet
$ownerQuery = "SELECT * FROM tblscooters WHERE userId = '$ownerId'";
$ownerResult = $conn->query($ownerQuery);
$ownerRowCount = $ownerResult->num_rows;

if(!($ownerRowCount >0)){
  echo  '<strong><div style="width: 30%; color: red; margin-left: 200px; margin-top: 20px;" class="alert-danger">
  You do not have any listing yet</div></strong>';
  exit();
}
else{
 
        //if the user has listings this query will find out if there is any request for approval for his vehicle
      // $sql = "SELECT * FROM requests r join tblscooters t on t.vid = r.vehicleId  
      // WHERE result= 'pending' AND t.userId = '$ownerId'";

      // $sql = "SELECT * FROM requests r join tblscooters t on t.vid = r.vehicleId join users u on r.requesterId = u.id
      // WHERE r.result= 'pending' AND t.userId = '$ownerId'";

  $sql = "SELECT * FROM requests r join users u on r.requesterId = u.id
  WHERE r.result= 'pending' AND r.ownerId = '$ownerId'";
  
  $result = $conn->query($sql);
  
  $rowCount = $result->num_rows;
  $number =1;
  if ($rowCount > 0) {
       //showing the table header first -->
   echo '<table class="table table-bordered table-striped ">
   <tr class="bg-dark text-white">
   <th>No.</th>
   <th>Requester Name</th>
   <th>Requester Passport<br> Number</th>
   <th>Message</th>
   <th>Vehicle Title</th>
   <th>Vehicle Brand</th>
   <th>Accept Action</th>
   <th>Reject Action</th>
   
   </tr>';
   while($row = $result->fetch_assoc()){
     
    ?>
    
    

    <tr>  
      <td><?php echo $number ?></td>
      <td><?php echo $row['fullname'] ?></td>
      <td><?php echo $row['passport'] ?></td>
      <td><?php echo $row['message'] ?></td>
      <td><?php echo $row['vehicleTitle'] ?></td>
      <td><?php echo $row['vehicleBrand'] ?></td>
      <td>
       <button onclick="onAcceptRequest(<?php echo $row['vehicleId'] ?>,<?php echo $row['requesterId'] ?>)" class="btn btn-success">Accept request</button>
     </td>
     <td>
       <button  onclick="onRejectRequest(<?php echo $row['vehicleId'] ?>,<?php echo $row['requesterId'] ?>)" class="btn btn-danger">Reject Request</button>
     </td>
     

   </tr>
   
   <?php
   $number++; 
   
 }
 echo "</table>";
}

else{
  echo  '<strong><div style="width: 30%; color: red; margin-left: 200px; margin-top: 20px;" class="alert-danger">
  No requests found yet for your listings</div></strong>';
} }?>