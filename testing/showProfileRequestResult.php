<script type="text/javascript" src="js/showScooters.js"></script>

<?php
    require 'config/db.php';
    session_start();

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

            }
            else{
                echo '<p class="alert-danger">Results not found</p>';
            }

            //if the user has history then we need to send request to that user
            $sql = "SELECT * FROM userhistory h join users u on u.id = h.userId
            WHERE u.passport=? OR u.fullname=?";
               
             $stmt = $conn->prepare($sql);
             $stmt->bind_param('ss', $searchInput,$searchInput);
             $stmt->execute();
             $result = $stmt->get_result();
             $row = $result->num_rows;
             $stmt->close();
 
         if($row > 0)
         {
            while($re = $result->fetch_assoc())
            {  ?>

        <?php
          $currentHistory = $re['historyId'];
          $requestSql = "SELECT * FROM profilerequest  WHERE requestFromId = '$myId' AND userHistoryId =  '$currentHistory'";
          $requestResult = $conn-> query($requestSql);
          $resultRow = $requestResult -> num_rows;
          
          if ($resultRow > 0) {
            while($row1 = $requestResult->fetch_assoc())
	           {
              $resultString = $row1['result'];

            if($resultString=="approved"){
               echo '<button onclick="viewUserHistory('.$re['historyId'].')" class="btn btn-primary">View Details</button>';
            }}} ?>
                <!-- sending the request to the owner for approval, we need to pass the vehicle id to that page so that
                we know which vehicle was requested for -->
              <input name="submit" type= "button"  
                  onclick="sendRequestForProfile(<?php echo $re['historyId']?>, <?php echo $re['userId']?>)" 
                  class="btn btn-success " style="margin: 0 auto"
                   value = "Send Requests to <?php echo $re['fullname'] ?> to view his/her profile" title="Please send request to user to be able to view the detailed history of the renter">
             
            
            
             <?php 
                 
       }}?>
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
                
              
            

