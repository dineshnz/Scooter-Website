<?php

require 'config/db.php';
error_reporting(0);
?>
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        
          <?php 
          
          $searchInput = $_POST['searchInput'];
           
          echo "hello";

          //Query for Listing count
            $sql = "SELECT id FROM tblscooters WHERE userId=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $searchInput);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->num_rows;
            $stmt->close();
            
            if($row > 0){
             ?>
          
          <div class="result-sorting-wrapper">
          <div class="sorting-count">
             <p><span><?php echo htmlentities($row);?> Listings</span></p>
          </div>
          </div>

            <?php }else{?>
                <div class="result-sorting-wrapper">
                <div class="sorting-count">
                   <p><span>No Listings are available from this customer</span></p>
                </div>
                </div>
           <?php }?>


           <?php
			$sql = "SELECT * FROM tblscooters WHERE userId=?";
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
			  <div class="product-listing-img"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage1']);?>" class="img-fluid" alt="Image" /> </a> 
			  </div>
			  <div class="product-listing-content">
				<h5><a href="vehical-details.php?vhid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['BrandName']);?> 
				 <?php echo htmlentities($row['VehiclesTitle']);?></a></h5>
				<p class="list-price">$<?php echo htmlentities($row['PricePerDay']);?> Per Day</p>
				<ul>
				  
				  <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['ModelYear']);?> model</li>
				  <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($row['FuelType']);?></li>
				</ul>
        <a href="scooterDetail.php?vhid=<?php echo htmlentities($row['id']);?>" class="btn btn-primary">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        <a href="#?vhid=<?php echo htmlentities($row['id']);?>" class="btn btn-success pull-right">Send Request <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
			  </div>
			</div>
      <?php }} ?>
     
	  </div>
	</div>
  </div>
	</section>