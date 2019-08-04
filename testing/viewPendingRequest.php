<?php
    require 'config/db.php';
    session_start();
      $passport = $_SESSION['passport'];

      $sql = "SELECT * FROM requests";
     $result = $conn->query($sql);
    
     $rowCount = $result->num_rows;
 
     if ($rowCount > 0) {
        while($row = $result->fetch_assoc()){
          $requesterID = $row['requesterId'];
          ?>
          <main role="main">
          <section class="jumbotron text-center">
              <div class="container">
                 <h1 class="jumbotron-heading"><?php echo $row['fullname'] ?></h1>
                  <p class="lead text-muted"><?php echo $row['message'] ?></p>
                  <p class="lead text-muted">For <?php echo $row['vehicleId'] ?></p>
                 <p>

                 <form class="d-inline" >
                   <input type="hidden" id="vid" value="<?php echo $row['vehicleId'] ?>">
                   <input type="hidden" id="requesterId" value="<?php echo $row['requesterId'] ?>">
                   <!-- <button name="acceptBtn" type="submit" class="btn btn-primary">Acceot Request</button> -->
                   <input name="submit" type= "button"  onclick="request()" class="btn btn-primary" 
                   value = "Accept Request">

                 </form>

                 <form action="reject.php" method="post" class="d-inline">
                   <input type="hidden" id="vid" value="<?php echo $row['vehicleId'] ?>">
                   <input type="hidden" id="requesterId" value="<?php echo $row['requesterId'] ?>">
                   <!-- <button name="rejectBtn" type="submit" class="btn btn-danger">Reject Request</button> -->
                   <input name="submit" type= "button"  onclick="onRejectRequest()" class="btn btn-danger" 
                   value = "Accept Request">
                 </form>
                 </p>
                 <small><i></i></small>

              </div>
   
          </section>

          </main>
        <?php } }else{
          echo "No request found";
        } ?>