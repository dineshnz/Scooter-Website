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
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/style.css">
	
  <script type="text/javascript" src="js/myProfileUpdate.js"></script>
  
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
                <h1>Update Password</h1>
              </div>
            </div>
          </div>
          <!-- Dark Overlay-->
          <div class="dark-overlay"></div>
        </section>
      </section>
   <?php 
  
   require_once 'controllers/authController.php';
    //retrieve id as it is set as primary key in the database
   $id=$_SESSION['id'];
   ?>

    <div class="row" style="margin-left:100px; margin-right:20px; margin-top:10px;">
      <div class="col-sm-8">
      <div class="update_password">
        <h1>Update Password</h1>
        <form>
          <input type="hidden" id="id" name="id" required="required" readonly value="<?php echo $id?>">
          <div class="form-group">
              <label>Current Password:<span class="text-danger">*</span> </label>
              <input type="password" id="currentPassword" class="form-control" name="currentPassword" required="required">
          </div>
          <div class="form-group">
            <label>New Password:<span class="text-danger">*</span> </label>
            <input type="password" id="newPassword" class="form-control" name="newPassword" required="required">
          </div>
          <div class="form-group">
            <label>Confirm New Password:<span class="text-danger">*</span> </label>
            <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" required="required">
          </div>
          <div class="form-group">
              <input type="button" value="Change Password" class="btn btn-primary form-control" onclick="updatePassword()">
          </div>
          <p id="response"></p>
     </form>
    </div>
  </div>
      <div class="col-sm-4">
        <?php  include('includes/profileSideBar.php');  ?>
      </div>
</div>
    </div></div>

 
<!-- a form to retrieve all the user data from the database, user can change it and press the update button to update the data in the database-->
</body>
</html>