<!DOCTYPE html>
<html>
<head>
  <title>My Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css">  
  <script type="text/javascript" src="js/myProfileUpdate.js"></script>
  
</head>
<body>
 <?php
    include('includes/profileSideBar.php');
    require_once 'controllers/authController.php';

    //Receive all the data based on what user has entered to login instead of searching in the database
    $id=$_SESSION['id'];
    $fullname=$_SESSION['username'];
    $email=$_SESSION['email'];
    $address=$_SESSION['address'];
    $passport=$_SESSION['passport'];
    $driverLicense=$_SESSION['license'];
 ?>
    <br>

    <div class="personal_information">
        <h1>General Information</h1>
            <form action="" method="post">
              <input type="hidden" id="id" name="id" required="required" readonly value="<?php echo $id?>"><br>
              <label>Full Name:</label><br>
              <input type="text" id="full_name" name="full_name" required="required" value="<?php echo $fullname?>"><br>
              <label>Email Address: </label><br>
              <input type="text" id="email_address" name="email_address" required="required" value="<?php echo $email?>"><br>
              <label>Address: </label><br>
              <input type="text" id="address" name="address" required="required" value="<?php echo $address?>"><br>
              <label>Passport Number: <label><br>
              <input type="text" id="passport_number" name="passport_number" required="required" value="<?php echo $passport?>"><br>
              <label>Driver License: </label><br>
              <input type="text" id="driver_license" name="driver_license" required="required" value="<?php echo $driverLicense?>"><br>
              <input type="button" value="Update" onClick="updateData()">
            </form>
            <p id="response"></p>
    </div>
    <!-- a form to retrieve all the user data from the database, user can change it and press the update button to update the data in the database-->
</body>
</html>