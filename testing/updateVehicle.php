<?php  
        require 'config/db.php';
        session_start();
      
      $vehicletitle=$_POST['vehicletitle'];
      $brand=$_POST['vehiclebrand'];
      $vehicleoverview=$_POST['vehicalorcview'];
      $priceperday=$_POST['priceperday'];
      $fueltype=$_POST['fueltype'];
      $modelyear=$_POST['modelyear'];
     
      $userId = $_SESSION['id'];
      
      $sql = "UPDATE tblscooters SET VehiclesTitle =?, VehiclesBrand =?, VehiclesOverview =?, PricePerDay=?,
      FuelType=?, ModelYear=? WHERE userId=? AND vid=?";
      

              $stmt = $conn->prepare($sql);
              $stmt->bind_param('sssisiii', $vehicletitle, $brand, $vehicleoverview, $priceperday, $fueltype, $modelyear, $userId);
      
              $resultSql = $stmt->execute();
      
      
      if($resultSql)
      {
      $msg="Vehicle updated successfully";
      }
      else 
      {
      $error="Something went wrong. Please try again";
      }
      
      
      


?>