<?php
    session_start();
    error_reporting(0);
    require 'config/db.php';
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Post a scooter</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/showScooters.js"></script>
	
	
    <style>
        .main{
            width: 70%;
        }
    </style>

</head>

<body>
	<?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
        
<?php

    
    
    $vhid= intval($_GET['vhid']);
    $username = $_SESSION['username'];
    $requesterId = $_SESSION['id'];
    $request ="pending";
    $message = "would like to view your scooter detail";

    $nameQuery = "SELECT * FROM requests WHERE requesterId=? AND vehicleId=? LIMIT 1";
    $stmt = $conn->prepare($nameQuery);
    $stmt->bind_param('ii', $requesterId, $vhid);
    $stmt->execute();
    $result = $stmt->get_result();
    $passportCount = $result->num_rows;
   
    
    $stmt->close();

    if ($passportCount > 0) {
       echo "request already sent";
       while($row = $result->fetch_assoc()){
           $_SESSION['vehicleResult'] = $row['result'];
       }

      
    }
    else{
   

    $sql = "INSERT INTO requests (fullname, message, vehicleId, result, requesterId)
     VALUES (?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisi', $username, $message, $vhid, $request, $requesterId);

    $resultSql = $stmt->execute();

    if(resultSql){
        $sql = "SELECT * FROM tblscooters WHERE vid=?";
        //$sql = "SELECT * FROM tblscooters t join users u on u.id = t.userId WHERE u.passport=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $vhid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->num_rows;
        $stmt->close();

    if($row > 0)
    {
    while($row = $result->fetch_assoc())
    {  ?>
        <div class="product-listing-m main" style="background:#eeeeee">
        <div class="product-listing-img"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage1']);?>" class="img-fluid" alt="Image" /> </a> 
        </div>
        <div class="product-listing-content">
          <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($row['vid']);?>"><?php echo htmlentities($row['VehiclesBrand']);?> 
           <?php echo htmlentities($row['VehiclesTitle']);?></a></h5>
          <p class="list-price">$<?php echo htmlentities($row['PricePerDay']);?> Per Day</p>
          <ul>
            
            <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['ModelYear']);?> model</li>
            <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($row['FuelType']);?></li>
          </ul>
            <button disabled>Request sent</button>
        </div>
      </div>
        <?php }}
    else{
        echo "Error";
    }

}

    }


?>
		
 </div>
</div>

			

	

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html> 