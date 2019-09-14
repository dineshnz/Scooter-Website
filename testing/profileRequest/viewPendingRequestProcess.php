<?php
session_start();
error_reporting(0);
//if user is not logged in then redirect user to login page
if (!isset($_SESSION['passport'])) {
  $_SESSION['msg'] = "You must log in first";
  $_SESSION['type'] = 'alert-danger';
  header('location: ../login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['passport']);
  header("location: login.php");
}

require '../config/db.php';


    // if(isset($_POST['readrecords'])){
$myId = $_SESSION['id'];

$sql = "SELECT * FROM profilerequest p join users u on p.requesteeId = u.id
WHERE p.result= 'pending' AND p.requesteeId = '$myId'";

$result = $conn->query($sql);

$rowCount = $result->num_rows;
$number =1;
if ($rowCount > 0) {
       //showing the table header first -->
 echo '<table class="table table-bordered table-striped ">
 <tr class="bg-dark text-white">
 <th>No.</th>
 <th>Requester Name</th>
 <th>Message</th>
 <th>Accept Action</th>
 <th>Reject Action</th>
 
 </tr>';
 while($row = $result->fetch_assoc()){
   
  ?>
  
  
<!-- showing the profile request. -->
  <tr>  
    <td><?php echo $number ?></td>
    <td><?php echo $row['requesterFullname'] ?></td>
    <td><?php echo $row['message'] ?></td>
    <td>
      <!-- sending requestfrom id to the server to send the information on where the request come from-->
     <button onclick="onAcceptRequest(<?php echo $row['requestFromId'] ?>)" class="btn btn-success">Accept request</button>
   </td>
   <td>
     <button  onclick="onRejectRequest(<?php echo $row['requestFromId'] ?>)" class="btn btn-danger">Reject Request</button>
   </td>
   

 </tr>
 
 <?php
 $number++; 
 
}
echo "</table>";
}

else{
  echo  '<strong><div style="width: 30%; color: red; margin-left: 200px; margin-top: 20px;" class="alert-danger">
  No requests found yet for your profile</div></strong>';
} ?>