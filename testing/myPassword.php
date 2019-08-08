<!DOCTYPE html>
<html>
<head>
  <title>My Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">  
  <script type="text/javascript" src="js/myProfileUpdate.js"></script>
  
</head>
<body>
 <?php 
    include('includes/profileSideBar.php'); 
    require_once 'controllers/authController.php';
    //retrieve id as it is set as primary key in the database
    $id=$_SESSION['id'];
 ?>
    <div class="update_password">
        <h1>Update Password</h1>
            <form action="myprofile_updateProcess.php" method="post">
                <input type="hidden" id="id" name="id" required="required" readonly value="<?php echo $id?>"><br>
                <label>Current Password: </label><br>
                <input type="password" id="currentPassword" name="currentPassword" required="required"><br>
                <label>New Password: </label><br>
                <input type="password" id="newPassword" name="newPassword" required="required"><br>
                <label>Confirm New Password: </label><br>
                <input type="password" id="confirmPassword" name="confirmPassword" required="required"><br>
                <input type="button" value="Change Password" onclick="updatePassword()">
                <p id="response"></p>
            </form>
    </div>
    <!-- a form to retrieve all the user data from the database, user can change it and press the update button to update the data in the database-->
</body>
</html>