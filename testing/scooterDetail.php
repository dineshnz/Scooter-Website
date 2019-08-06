<?php 
session_start();
require 'config/db.php';
require_once 'config/stripeConfig.php';
error_reporting(0);

//on submit button clicked, get all the message (havent implemented yet)
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status) 
VALUES(?, ?, ?, ?, ?, ?)";
$query = $conn->prepare($sql);

$query-> bind_param('sisssis',$useremail, $vhid, $fromdate, $todate, $message, $status);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Scooter Detail</title>
<!-- Font awesome -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Sandstone Bootstrap CSS -->
  
  
 
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/css/style1.css" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="css/purple.css" type="text/css">

<!--OWL Carousel slider-->
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/owl.carousel.min.css" rel="stylesheet">
<link href="css/owl.theme.default.min.css" rel="stylesheet">


<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<style>
.page-wrapper{
  margin-left: 20px;
  max-width: 95%;
}
</style>
</head>
<body>
<?php include('includes/profileHeader.php');?>
  <div class="ts-main-content">
  <?php include('includes/leftbar.php');?>
    <div class="content-wrapper">
  <?php
  //this gets the value of vehicle id from the url to show the details of the clicked vehicle 
$vhid=intval($_GET['vhid']);

$sql =" SELECT * from tblscooters where vid=?";
$query = $conn -> prepare($sql);
$query->bind_Param('i', $vhid);
$query->execute();
$results=$query->get_result();
$count = $results->num_rows;


$cnt=1;
if($count > 0)
{
  while($row = $results->fetch_assoc())
  {  
  //displaying the images in the top of the page, if the image is empty in the database, then it will display empty string
  ?>  
  <div class="owl-carousel owl-theme">
  <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage1']);?>" class="img-fluid" alt="Image" /> </div> 
  
  <?php if($row['Vimage2']=="")
{

} else {
  ?>
 <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage2']);?>" class="img-fluid" alt="Image" /></div>
  <?php } ?>

  <?php if($row['Vimage3']=="")
{

} else {
  ?>
 <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage3']);?>" class="img-fluid" alt="Image" /></div>
  <?php } ?>

  <?php if($row['Vimage4']=="")
{

} else {
  ?>
 <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage4']);?>" class="img-fluid" alt="Image" /></div>
  <?php } ?>

  <?php if($row['Vimage5']=="")
{

} else {
  ?>
 <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage5']);?>" class="img-fluid" alt="Image" /></div>
  <?php } ?>
  

 </div>

 



  <!-- Listing details -->
  <section class="listing-detail">
    <div class="page-wrapper">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($row['VehiclesBrand']);?> , <?php echo htmlentities($row['VehiclesTitle']);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>$<?php echo htmlentities($row['PricePerDay']);?> </p>Per Day
         
        </div>
      </div>
    </div>
      
    
     <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['ModelYear']);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['FuelType']);?></h5>
              <p>Fuel Type</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
          
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                
                <p><?php echo htmlentities($row['VehiclesOverview']);?></p>
              </div>
              
              
              <!-- Accessories -->
              <div role="tabpanel" class="tab-pane" id="accessories"> 
                <!--Accessories-->
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Accessories</th>
                    </tr>
                  </thead>
                  <tbody>
                    
<tr>
<td>AntiLock Braking System</td>
<?php if($row['AntiLockBrakingSystem']==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
   </tr>


        
                   
 
<tr>
<td>Leather Seats</td>
<?php if($row['LeatherSeats']==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>


<tr>
<td>Brake Assist</td>
<?php if($row['BrakeAssist']==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php  } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>




                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>

        <!-- setting session variables for the payments -->
       <?php 
       $_SESSION['price'] = $row['PricePerDay'];
       

       ?>
        

        <form action="stripeIPN.php?id=<?php echo $vhid; ?>" method="POST"
        ><input type="hidden" name="id" value="<?=$vhid;?>" />
        
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key=<?php echo $stripeDetails['publishableKey'] ?>
    data-amount=<?php echo $row['PricePerDay']*100?>
    data-name=  <?php echo htmlentities($row['VehiclesTitle']);?>
    data-description= <?php echo htmlentities($row['VehiclesBrand']);?>
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-currency="nzd">
  </script>
</form>


<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
          </div>
          <form method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
            </div>
            <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>
          <?php if($_SESSION['passport'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

              <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>

    </div>

  </section>


  

  </div>
  </div>


<!-- Loading Scripts -->
<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script> 
<script src="js/owl.carousel.min.js"></script>

<script src="js/scooterDetail.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>