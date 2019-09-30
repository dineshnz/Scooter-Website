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
?><!DOCTYPE html>
<html>
<head>
  <title>My Profile</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/style.css">
	
  <script type="text/javascript" src="js/contactUs.js"></script>
  <script type="text/javascript" src="js/myProfileUpdate.js"></script>
  <style>
    #length{
      width: 500px;
    }

  </style>

</head>
<body>
<?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
    <div class="content-wrapper" >
    
     <!-- header of the page -->
     <section class="page-header profile_page">
      <div class="content">
        <section class=" profile_page">
          <div class="container">
            <div class="page-header_wrap">
              <div class="page-heading">
                <h1>Update Profile</h1>
              </div>
            </div>
          </div>
          <!-- Dark Overlay-->
          <div class="dark-overlay"></div>
        </section>
      </section>
  <?php
 
  require_once 'controllers/authController.php';

  

  //Receive all the data about the users
  $id=$_SESSION['id'];
  $sql = "SELECT * FROM users where id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->num_rows;
        $stmt->close();

        
        if($row > 0){
          $user = mysqli_fetch_assoc($result);
  ?>
 
  <div class="row"  style="margin-left:100px; margin-right:20px; margin-top:10px;">
    <div class="col-sm-8">
    <div class="personal_information">
    <h1>General Information</h1>
    <form >
      <div class="form-group">
         <input type="hidden" id="id" name="id" required="required" readonly value="<?php echo $user['id']?>">
      </div>
      <div class="form-group" id="length">
          <label class="control-label">Full Name:</label><br>
          <input type="text" id="full_name" name="full_name" class="form-control"
           required="required" value="<?php echo $user['fullname']?>">
      </div>

      <div class="form-group" id="length">
          <label class="control-label">Email Address: </label>
          <input type="text" id="email_address" name="email_address" class="form-control"
          required="required" value="<?php echo $user['email']?>">
      </div>
      <div class="form-group" id="length">
          <label class="control-label">Address: </label>
          <input type="text" id="address" name="address" class="form-control"
          required="required" value="<?php echo $user['address']?>" >
      </div>
      <div class="form-group" id="length">
          <label class="control-label">Passport Number: </label>
          <input type="text" id="passport_number" name="passport_number" class="form-control"
          required="required" readonly value="<?php echo $user['passport']?>" disabled 
          title="Please send request to admin to update your passport number">
      </div>
      <div class="form-group" id="length">
          <label class="form-group">Driver License: </label>
          <input type="text" id="driver_license" name="driver_license" class="form-control"
           required="required" readonly value="<?php echo $user['driverLicense']?>" disabled
           title="Please send request to admin to update your Driver License number">
      </div>
      <div class="form-group" id="length">
         <input type="button" class="btn btn-primary form-control" value="Update" onClick="sendContact()">
      </div>
       
      </form>
      <p id="response"></p>
    </div>
    </div>

        <?php }?>
    

    <!-- keeping menus on right -->
    <div class="col-sm-4">
        <?php  include('includes/profileSideBar.php'); ?>
        <hr>
        <strong><p>Send Request to admin to update passport and license</p></strong>
        <form >
          <div class="form-group">
              <label class="control-label">Username: </label>
              <input type="text" id="uname" name="uname" class="form-control" required="required" placeholder="First Name">
          </div>
           <div class="form-group">
             <label class="control-label">Email:</label>
             <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Email">
           </div>
           <div class="form-group">
             <label class="control-label">Subject:</label>
             <input type="text" id="subject" name="subject" class="form-control" required="required" placeholder="Subject">
           </div>
           <div class="form-group">
             <label class="control-label">Driver License:</label>
             <input type="text" id="driverLicense" name="driverLicense" class="form-control" required="required" placeholder="Subject">
           </div>
           <div class="form-group">
             <label class="control-label">Passport:</label>
             <input type="text" id="passport" name="passport" class="form-control" required="required" placeholder="Subject">
           </div>
           <div class="form-group">
              <label class="control-label">Message: </label>
              <textarea name="message" id="message" class="form-control" rows="3" placeholder="Message"></textarea>
           </div>
          <div class="form-group">
              <input type="button" class="btb btn-primary" value="Submit" onclick="sendContact()">
              <input type="reset" class="btb btn-danger" value="Reset">
          </div> 
           
            
  </form>
    </div>
  </div>



  
 
    <!-- a form to retrieve all the user data from the database, user can change it and press the update button to update the data in the database-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

 
  </body>
  </html>

  