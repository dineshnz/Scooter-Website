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
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My Active assets</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/style.css">
        
        <style>

   .box
   {
    width:95%;
    padding:10px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:10px;
   }

   #records_content{
       width: 90%;
       margin-left:30px;
   }

   .content{
          width:  100%;
          margin-top: 0px;
          
      }
  </style>
 </head>
 <body>
 <?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper" style="margin-top: 0px!important;">
            <!-- header of the page -->
            <section class="page-header profile_page">
            <div class="content">
        <section class=" profile_page">
            <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>My Currently Rented Scooters</h1>
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
</section>
  
<section class="listing-page" style="margin-top:30px; margin-left:90px;">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
      <?php 
          $myId = $_SESSION['id'];
          $passportNo = $_SESSION['passport'];

           
            //this will search the scooters related to the owner which 
           $sql = "SELECT * FROM tblscooters s join transactions t on s.vid = t.vehicleId join users u on u.id = t.paidToId
           WHERE u.id = ? AND t.returnStatus ='0'";
              
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $myId);
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
                    
                    <ul>
                      
                      <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['ModelYear']);?> model</li>
                      <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($row['FuelType']);?></li>
                    </ul>
                    <a href="returnVehicleDetail.php?vhid=<?php echo htmlentities($row['vid']);?>" class="btn btn-primary">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
              </div>
        </div>
        <?php }}else{
          echo '<p style="color:red"> No records found</p>';}?>
      </div>
    </div>
  </div>
</section>

        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
 </body>
</html>






