<?php 
require '../config/db.php';
session_start();
extract($_POST);
$ownerId = $_SESSION['id'];

//displaying the records to the page. 
if(isset($_POST['readrecords'])){

    $displayquery = " SELECT * FROM tblScooters where userId =?"; 
    $stmt = $conn->prepare($displayquery);
    $stmt->bind_param('i',  $ownerId);
        
    if ($stmt->execute()) {
        $data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>No.</th>
							<th>Vehicle Image</th>
							<th>Vehicle Overview</th>
							<th>Vehicle OverView</th>
							<th>Vehicle Brand</th> 
							<th>Price Per Day</th> 
							<th>Edit Action</th>
							<th>Delete Action</th>
							<th>View Detail</th>
						</tr>'; 
        $number = 1;
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()){
        
        $data .= '<tr>  
                <td>'.$number.'</td>
                <td><img src="Images/uploadedImages/'.$row['Vimage1'].'" class="img-fluid" alt="Image" 
                style ="height:100px; width:200px" /></td>
				<td>'.$row['VehiclesTitle'].'</td>
				<td>'.$row['VehiclesOverview'].'</td>
                <td>'.$row['VehiclesBrand'].'</td>
                <td>'.$row['PricePerDay'].'</td>
				<td>
					<button onclick="GetVehicleDetails('.$row['vid'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="DeleteVehicle('.$row['vid'].')" class="btn btn-danger">Delete</button>
                </td>
                <td>
                <a href="scooterDetail.php?vhid='.$row['vid'].'" class="btn btn-primary">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                </td>
            </tr>';
            $number++;
        }
    }
    $data .= '</table>';
    echo $data;
    
}



	// pass id on modal
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    $scooter_id = $_POST['id'];
    $sql = "SELECT * FROM tblscooters WHERE vid = ? AND userId=?";
    $query = $conn -> prepare($sql);
    $query->bind_Param('ii', $scooter_id, $ownerId);
    $query->execute();
    $results=$query->get_result();
    $count = $results->num_rows;


$response = array();

if($count > 0) {
    while ($row = $results->fetch_assoc()) {
   
        $response = $row;
    }
}

else
{
    $response['status'] = 200;
    $response['message'] = "Data not found!";
}
//     PHP has some built-in functions to handle JSON.
// Objects in PHP can be converted into JSON by using the PHP function json_encode(): 

echo json_encode($response);
}

//this will look into the id and if the id is not right, then it will pass invalid data
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}
//////////////// update table//////////////

if(isset($_POST['hidden_scooter_id']))
{
    // get values
    $hidden_scooter_id = $_POST['hidden_scooter_id'];
    $title = $_POST['title'];
    $overview = $_POST['overview'];
    $price = $_POST['price'];
    
    $query = "UPDATE tblscooters SET VehiclesTitle = '$title', VehiclesOverview = '$overview', PricePerDay = '$price'  WHERE vid = '$hidden_scooter_id'";
    $result = $conn->query($query);

    if($result){
        echo "successfully updated";
    }
    else{
        echo "Failed update";
    }
}
/////////////Delete user record /////////

if(isset($_POST['deleteid']))
{

	$scooter_id = $_POST['deleteid']; 

	$deletequery = " DELETE FROM tblscooters WHERE vid =? AND userId =? ";
    $query = $conn -> prepare($deletequery);
    $query->bind_Param('ii', $scooter_id, $ownerId);
    $query->execute();
    

}



?>