<!-- controller to handle the process to show the scooter when user searches the scooter related to owner -->
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


$resultString ="";
?>
<script type="text/javascript" src="js/showScooters.js"></script>
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        
        
        <?php 
          //getting input from users and getting session values of logged in user
        $searchInput = strtolower($_POST['searchInput']);
        $requesterID = $_SESSION['id'];
        $passportNo = $_SESSION['passport'];
        $fullname = strtolower($_SESSION['username']);
        
        
        
        

          //Query for Listing count. This will show the number of vehicles related to the owner passport input
        $sql = "SELECT vid FROM tblscooters t join users u on u.id = t.userId
        WHERE u.passport=? OR u.fullname=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $searchInput, $searchInput);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->num_rows;
        $stmt->close();
        
        if($row > 0){
          if($passportNo == $searchInput || $fullname == $searchInput ){

            
            ?>
            <div class="result-sorting-wrapper">
              <div class="sorting-count">
               <p><span><?php echo htmlentities($row);?> Listings And you are the owner of this vehicle</span></p>
             </div>
           </div>
         <?php } else{?>
          
          <div class="result-sorting-wrapper">
            <div class="sorting-count">
             <p><span><?php echo htmlentities($row);?> Listings! </span></p>
           </div>
         </div>

       <?php }}else{?>
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
           <p><span>No Listings are available from this customer</span></p>
         </div>
       </div>
     <?php }?>


     <?php
            //if the user is owner then this will show his/her vehicle so that they do not have to send request
            //to view their own vehicle.
     if($passportNo == $searchInput || $fullname == $searchInput ){
       include 'includes/showSuperUserResult.php';
     }
     else{
            //this will search the scooters related to the owner which 
       $sql = "SELECT * FROM tblscooters t join users u on u.id = t.userId
       WHERE u.passport=? OR u.fullname=?";
       
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('ss', $searchInput,$searchInput);
       $stmt->execute();
       $result = $stmt->get_result();
       $row = $result->num_rows;
       $stmt->close();

       if($row > 0)
       {
         while($row = $result->fetch_assoc())
           {  ?>
             <div class="product-listing-m" style="background:#eeeeee">
              <div class="product-listing-img"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage1']);?>" 
                class="img-fluid" style="height: 220px" alt="<?php echo $row['VehiclesTitle'] ?>" /> </a> 
              </div>
              <div class="product-listing-content">
                <h5><a href="scooterDetail.php?vhid=<?php echo htmlentities($row['vid']);?>"><?php echo htmlentities($row['VehiclesBrand']);?> 
                <?php echo htmlentities($row['VehiclesTitle']);?></a> </h5>
                
                <p class="list-price">$<?php echo htmlentities($row['PricePerDay']);?> Per Day</p>
                <h4>Owner: <?php echo htmlentities($row['fullname'])?></h4>
                <ul>
                  
                  <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['ModelYear']);?> model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($row['FuelType']);?></li>
                </ul>
                
                
                <div id="resultDiv"></div>

                <?php
                $currentVid = $row['vid'];
                $requestSql = "SELECT * FROM requests r WHERE r.requesterId = '$requesterID' AND r.vehicleId =  '$currentVid'";
                $requestResult = $conn-> query($requestSql);
                $resultRow = $requestResult -> num_rows;
                
                if ($resultRow > 0) {
                  while($row1 = $requestResult->fetch_assoc())
                  {
                    $resultString = $row1['result'];

                    if($resultString=="approved"){
                      ?>
                      <!-- once the vehicle request is approved, this will show the show details buttons to the user  -->
                      <a href="scooterDetail.php?vhid=<?php echo htmlentities(urlencode($row['vid']));?>&ownerId=<?php echo htmlentities(urlencode($row['userId']));?>"
                       class="btn btn-primary">View Details <span class="angle_arrow">
                         <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                       <?php }
            // if the result string for this vehicle is pending then show pending message to the user.
                       else if($resultString=="pending"){?>
                        <button class="btn btn-danger" disabled title="Please wait until owner approves your request">
                        Request Sent</button>
                      <?php } else if($resultString=="rejected"){ ?>
                       <button class="btn btn-danger" disabled 
                       title="Your request to view this vehicle has been rejected by owner of this vehicle">
                     Request Rejected by owner</button>
                   <?php }
                 }}else{ ?>
        <!-- sending the request to the owner for approval, we need to pass the vehicle id to that page so that
          we know which vehicle was requested for -->

          <?php 
          $vehicleTitle = $row['VehiclesTitle'];
          $vehicleBrand = $row['VehiclesBrand'];
          ?>
          <input name="submit" type= "button" name="requrstBtn"  
          onclick="sendRequestForApproval(<?php echo $row['vid']?>, <?php echo $row['userId']?>, 
          '<?php echo $vehicleTitle ?>', '<?php echo $vehicleBrand ?>')"
          class="btn btn-primary pull-right" 
          value = "Send Requests for approval" 
          title="Please send request to owner to be able to view the detail of the vehicle">
        <?php } ?>
        
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
      </div>
    </div>
  <?php }}} ?>
  
</div>
</div>
</div>
</section>




