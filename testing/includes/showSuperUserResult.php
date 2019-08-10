<?php

$sql = "SELECT * FROM tblscooters t join users u where t.userId = u.id AND u.passport =? or u.fullname=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $searchInput, $searchInput);
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
        <a href="scooterDetail.php?vhid=<?php echo htmlentities($row['vid']);?>" class="btn btn-primary">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
              </div>
              
			</div>
      <?php }} ?>