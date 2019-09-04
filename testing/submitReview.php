<?php 
session_start();
require 'config/db.php';

//on submit button clicked, get all the message (havent implemented yet)
 
       $paidToId = $_POST['ownerId'];
       $ownerResponse = $_POST['message'];
    //   select the tblscooter and transaction table to view vehicle brought column and userId (renterId) column
    $query = "select * from tblscooters s join transactions t on t.vehicleId = s.vid where t.paidToId =?";
    $query = $conn -> prepare($query);
    $query->bind_Param('i', $paidToId);
    $query->execute();
    $results=$query->get_result();
    $count = $results->num_rows;
    if($count > 0){
      while($row = $results->fetch_assoc()){
            $vehicleBrought = $row['VehiclesTitle'];
            $userId = $row['paidById'];

            //lets check if the owner has already provided review
            $sql = "SELECT historyId FROM userhistory WHERE userId=? AND ownerId=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $userId, $paidToId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->num_rows;
            $stmt->close();

            //if the row is greater than 0 that means owner has provided the review
            if($row > 0){
                echo "You have already reviewed this user";
            }
            else{

            


            $sql = "INSERT INTO userhistory(ownerResponse, userId, ownerId, vehicleBrought)
             VALUES (?, ?, ?, ?)";
             $query1 = $conn->prepare($sql);

             $query1-> bind_param('siis',$ownerResponse, $userId, $paidToId, $vehicleBrought);
             $result = $query1->execute();
            
             if($result){
               
               echo "Review Posted successfully";
              

             }else{
               echo "something went wrong";
             }
       }
    } 
}
    else{
        echo "The vehicle is not rented by anyone";
    }


?>