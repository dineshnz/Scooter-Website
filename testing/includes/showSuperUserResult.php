<?php
require 'config/db.php';
$sql = "SELECT * FROM tblscooters t join users u where t.userId = u.id AND u.passport =?";
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
				<h5><a href="vehical-details.php?vhid=<?php echo htmlentities($row['vid']);?>"><?php echo htmlentities($row['VehiclesBrand']);?> 
				 <?php echo htmlentities($row['VehiclesTitle']);?></a></h5>
				<p class="list-price">$<?php echo htmlentities($row['PricePerDay']);?> Per Day</p>
				<ul>
				  
				  <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['ModelYear']);?> model</li>
				  <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($row['FuelType']);?></li>
        </ul>
			  </div>
			</div>
      <?php }} ?>