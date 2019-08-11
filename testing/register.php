<?php require_once "controllers/authController.php"  ?>

<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="fullname" >
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email">
  	</div>
    <div class="input-group">
      <label>Passport Number</label>
      <input type="text" name="passport">
    </div>
    <div class="input-group">
      <label>Address</label>
      <input type="text" name="address">
    </div>
    <div class="input-group">
      <label>Driver License number</label>
      <input type="text" name="license" >
    </div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="confirmpassword">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="log.php">Sign in</a>
  	</p>
  </form>
</body>
</html>