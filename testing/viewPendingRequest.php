<script src="js/showScooters.js"></script>

<?php
    require 'config/db.php';
    session_start();
      $ownerId = $_SESSION['id'];

      //checking if the current logged in person has any listing if there is no listing to this
      //owner then this will print that the user does not have any listing yet
      $ownerQuery = "SELECT * FROM tblscooters WHERE userId = '$ownerId'";
      $ownerResult = $conn->query($ownerQuery);
      $ownerRowCount = $ownerResult->num_rows;

      if(!$ownerRowCount > 0){
        echo  '<strong><div style="width: 30%; color: red; margin-left: 200px; margin-top: 20px;" class="alert-danger">
        You do not have any listing yet</div></strong>';
      }
      else{
        //if the user has listings this query will find out if there is any request for approval for his vehicle
      $sql = "SELECT * FROM requests r join tblscooters t on t.vid = r.vehicleId  WHERE result= 'pending' AND t.userId = '$ownerId'";
     $result = $conn->query($sql);
    
     $rowCount = $result->num_rows;
 
     if ($rowCount > 0) {
        while($row = $result->fetch_assoc()){
         
          ?>
          <main role="main">
          <section class="jumbotron text-center">
              <div class="container">
                 <h1 class="jumbotron-heading"><?php echo $row['fullname'] ?></h1>
                  <p class="lead text-muted"><?php echo $row['message'] ?></p>
                  <p class="lead text-muted">For <?php echo $row['vehicleId'] ?></p>
                 <p>

                 <div class="d-inline" >
                   <input name="submit" type= "button"  onclick="onAcceptRequest(<?php echo $row['vehicleId'] ?>,<?php echo $row['requesterId'] ?>)" class="btn btn-primary" 
                   value = "Accept Request">
                </div>

                 <div class="d-inline">
                   <input name="submit" type= "button"  onclick="onRejectRequest(<?php echo $row['vehicleId'] ?>,<?php echo $row['requesterId'] ?>)" class="btn btn-danger" 
                   value = "Reject Request">
                 </div>
                 </p>
                 <small><i></i></small>

              </div>
   
          </section>

          </main>
        <?php }}else{
          echo  '<strong><div style="width: 30%; color: red; margin-left: 200px; margin-top: 20px;" class="alert-danger">
          No requests found yet for your listings</div></strong>';
        } }?>