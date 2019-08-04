<?php  
        require 'config/db.php';
        session_start();
      
      $vehicletitle=$_POST['vehicletitle'];
      $brand=$_POST['vehiclebrand'];
      $vehicleoverview=$_POST['vehicalorcview'];
      $priceperday=$_POST['priceperday'];
      $fueltype=$_POST['fueltype'];
      $modelyear=$_POST['modelyear'];
      $vimage1=$_FILES["img1"]["name"];
      $vimage2=$_FILES["img2"]["name"];
      $vimage3=$_FILES["img3"]["name"];
      $vimage4=$_FILES["img4"]["name"];
      $vimage5=$_FILES["img5"]["name"];
      $userId = $_SESSION['id'];
      $antilockbrakingsys=$_POST['antilockbrakingsys'];
      $brakeassist=$_POST['brakeassist'];
      $leatherseats=$_POST['leatherseats'];
      move_uploaded_file($_FILES["img1"]["tmp_name"],"Images/uploadedImages/".$_FILES["img1"]["name"]);
      move_uploaded_file($_FILES["img2"]["tmp_name"],"Images/uploadedImages/".$_FILES["img2"]["name"]);
      move_uploaded_file($_FILES["img3"]["tmp_name"],"Images/uploadedImages/".$_FILES["img3"]["name"]);
      move_uploaded_file($_FILES["img4"]["tmp_name"],"Images/uploadedImages/".$_FILES["img4"]["name"]);
      move_uploaded_file($_FILES["img5"]["tmp_name"],"Images/uploadedImages/".$_FILES["img5"]["name"]);
      
      
      $sql = "INSERT INTO tblscooters(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,
      Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AntiLockBrakingSystem,BrakeAssist,LeatherSeats,userId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      
      
              $stmt = $conn->prepare($sql);
              $stmt->bind_param('sssisisssssiiii', $vehicletitle, $brand, $vehicleoverview, $priceperday, $fueltype, $modelyear, 
              $vimage1,$vimage2,$vimage3,$vimage4,$vimage5, $antilockbrakingsys, $brakeassist, $leatherseats, $userId);
      
              $resultSql = $stmt->execute();
      
      
      if($resultSql)
      {
      $msg="Vehicle posted successfully";
      }
      else 
      {
      $error="Something went wrong. Please try again";
      }
      
      
      


?>