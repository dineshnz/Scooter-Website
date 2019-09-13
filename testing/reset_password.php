<?php 
session_start();
error_reporting(0);

include 'controllers/authController.php';
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
  <title>Reset Password</title>
</head>
<body>
  <?php include 'header.php' ?>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth login">
        <h3 class="text-center form-title">Reset Password</h3>
        <form action="reset_password.php" method="post">
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
            <label>Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="passwordConf" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <button type="submit" name="reset-password-btn" class="btn btn-lg btn-block">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>