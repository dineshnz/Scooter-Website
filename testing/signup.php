<?php include 'controllers/authController.php';
if (isset($_SESSION['passport'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: userProfile.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['passport']);
  header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main1.css">
  <title>User verification system PHP</title>
</head>
<body>
<?php include 'header.php' ?>
  <div class="container" style = "margin-top: 60px">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth">
        <h3 class="text-center form-title">Register</h3>
        <form action="signup.php" method="post">
          <?php if (count($errors) > 0): ?>
          <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
            <li>
              <?php echo $error; ?>
            </li>
            <?php endforeach;?>
          </div>
          <?php endif;?>

          
          <!-- Display messages -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?php echo $_SESSION['type'] ?>">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['type']);
          ?>
        </div>
        <?php endif;?>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="fullname" class="form-control form-control-lg" value="<?php echo $fullname; ?>">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>">
          </div>
          <div class="form-group">
            <label>Passport Number</label>
            <input type="text" name="passport" class="form-control form-control-lg" value="<?php echo $passport; ?>">
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control form-control-lg" value="<?php echo $address; ?>">
          </div>
          <div class="form-group">
            <label>Driver License Number</label>
            <input type="text" name="license" class="form-control form-control-lg" value="<?php echo $license; ?>">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <label>Password Confirm</label>
            <input type="password" name="confirmpassword" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <button type="submit" name="signup-btn" class="btn btn-lg btn-block">Sign Up</button>
          </div>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
</body>
</html>