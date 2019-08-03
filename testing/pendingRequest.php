<?php

require 'config/db.php';

session_start();
$requesterID = "";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pending Request System in PHP and MySql</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
  

  <?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

      <?php
      $passport = $_SESSION['passport'];

      $sql = "SELECT * FROM tblscooters t join users u on u.id = t.userId join requests r on t.vid = r.vehicleId AND u.id =r.requesterId WHERE u.passport=? AND r.result = 'pending'";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('s', $passport);
     $stmt->execute();
     $result = $stmt->get_result();
     $passportCount = $result->num_rows;
    
     
     $stmt->close();
 
     if ($passportCount > 0) {
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

                 <form action="accept.php" method="post" class="d-inline" >
                   <input type="hidden" name="vid" value="<?php echo $row['vehicleId'] ?>">
                   <input type="hidden" name="requesterId" value="<?php echo $row['userID'] ?>">
                   <button name="acceptBtn" type="submit" class="btn btn-primary">Acceot Request</button>
                 </form>

                 <form action="reject.php" method="post" class="d-inline">
                   <input type="hidden" name="vid" value="<?php echo $row['vehicleId'] ?>">
                   <input type="hidden" name="requesterId" value="<?php echo $row['userID'] ?>">
                   <button name="rejectBtn" type="submit" class="btn btn-danger">Reject Request</button>
                 </form>
                 </p>
                 <small><i></i></small>

              </div>
   
          </section>

          </main>
        <?php } } ?>

        

            </div>
        </div>
    </div>

    

   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>