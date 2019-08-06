<?php

require 'config/db.php';

session_start();
$resultString ="";
?>
 <script type="text/javascript" src="js/showScooters.js"></script>
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
      
        
          <?php 
          //getting input from users and getting session values of logged in user
          $searchInput = $_POST['searchInput'];
          $requesterID = $_SESSION['id'];
          $passportNo = $_SESSION['passport'];
           
        

          //Query for Listing count. This will show the number of vehicles related to the owner passport input
            $sql = "SELECT vid FROM tblscooters t join users u on u.id = t.userId WHERE u.passport=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $searchInput);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->num_rows;
            $stmt->close();
            
            if($row > 0){
              if($passportNo == $searchInput){
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
           if($passportNo == $searchInput){
             include 'includes/showSuperUserResult.php';
           }
           else{
            //this will search the scooters related to the owner which 
           $sql = "SELECT * FROM tblscooters t join users u on u.id = t.userId
           WHERE u.passport=?";
              
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $searchInput);
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
            class="img-fluid" style="height: 191px" alt="<?php echo $row['VehiclesTitle'] ?>" /> </a> 
			  </div>
			  <div class="product-listing-content">
				<h5><a href="vehical-details.php?vhid=<?php echo htmlentities($row['vid']);?>"><?php echo htmlentities($row['VehiclesBrand']);?> 
				 <?php echo htmlentities($row['VehiclesTitle']);?></a></h5>
				<p class="list-price">$<?php echo htmlentities($row['PricePerDay']);?> Per Day</p>
				<ul>
				  
				  <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['ModelYear']);?> model</li>
				  <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($row['FuelType']);?></li>
        </ul>

        

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
          <a href="scooterDetail.php?vhid=<?php echo htmlentities($row['vid']);?>" class="btn btn-primary">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
              <?php }}} ?>
        <!-- sending the request to the owner for approval, we need to pass the vehicle id to that page so that
      we know which vehicle was requested for -->
              <input name="submit" type= "button" name="requrstBtn"  
                  onclick="sendRequestForApproval(<?php echo $row['vid'] ?>)" 
                  class="btn btn-primary pull-right" 
                   value = "Send Requests for approval" title="Please send request to owner to be able to view the detail of the vehicle">
             
            
            
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
 

 
  
 