<!-- page to display profile requests to the user. -->
<script type="text/javascript" src="js/showScooters.js"></script>

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


    //getting input from users and getting session values of logged in user
$searchInput = strtolower($_POST['searchInput']);
$myId = $_SESSION['id'];
$passportNo = $_SESSION['passport'];
$fullname = strtolower($_SESSION['username']);

    //querying to see if the person has any records/history if yes it should show link to send request
    //to view the profile of that person else it should show no results found
$sql = "SELECT historyId FROM userhistory h join users u on u.id = h.userId
WHERE u.passport=? OR u.fullname=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $searchInput, $searchInput);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->num_rows;
$stmt->close();


if($row > 0){
  echo '<p class="alert-success">Results found</p>';
$userQuery ="SELECT * FROM users WHERE passport='$searchInput' OR fullname='$searchInput'";
$userResult= $conn->query($userQuery);
$userRow = $userResult->num_rows;

if($userRow>0){
  while($re= $userResult->fetch_assoc()){
  $userToLookFor = $re['id'];
   $fullNameOfUser= $re['fullname'];
 }
}



$requestSql = "SELECT * FROM profilerequest  WHERE requestFromId = '$myId' AND requesteeId =  '$userToLookFor'";
$requestResult = $conn-> query($requestSql);
$resultRow = $requestResult -> num_rows;

if ($resultRow > 0) {
  while($row1 = $requestResult->fetch_assoc())
  {
    $resultString = $row1['result'];
  }

  if($resultString=="approved"){?>
    <button onclick="viewUserHistory(<?php echo $userToLookFor ?>)" class="btn btn-primary">View Details</button>
  <?php }else if($resultString=="rejected"){ ?>
    <!-- showing rejected option -->
    <button class="btn btn-danger" disabled>Your request to view renter's profile has been rejected</button>
  <?php }else if($resultString=="pending"){?>
    <button class="btn btn-danger" disabled>Request sent to view profile</button>
  <?php }?>
  
<?php }else{?>
        <!-- sending the request to the owner for approval, we need to pass the vehicle id to that page so that
          we know which vehicle was requested for -->
          <input name="submit" type= "button"  
          onclick="sendRequestForProfile(<?php echo $userToLookFor ?>)" 
          class="btn btn-success " style="margin: 0 auto"
          value = "Send Requests to <?php echo $fullNameOfUser ?> to view his/her profile" 
          title="Please send request to user to be able to view the detailed history of the renter">

        <?php }?>

<?php }
else{
  echo '<p class="alert-danger">No history found or this user may not exist</p>';
}?>



        <div id="targetDiv"></div>
        <!--Start of modal to show results-->
        <div class="modal fade" id="responseModal" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Response</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body" id="success">
                
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>    



        
        
        

