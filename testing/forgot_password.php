<?php 
session_start();
error_reporting(0);

?>

<?php include 'controllers/authController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style2.css">
  <title>Forgot Password</title>
</head>
<body>
    <?php include 'header.php' ?>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth login">
        <h3 class="text-center form-title">Recover your Password</h3>
       
        <form action="forgot_password.php" method="post">
        <p>Please enter your email address you used to sign up on this site and we will
        assist you in recovering your password.</p>
        <!-- display error message -->
          <?php if (count($errors) > 0): ?>
          <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
            <li>
              <?php echo $error; ?>
            </li>
            <?php endforeach;?>
          </div>
          <?php endif;?>

      
          <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>">
          </div>
          <div class="form-group">
            <button type="submit" name="forgot-password" class="btn btn-lg btn-block">Recover your password</button>
          </div>
        </form>

            <!-- Display success messages -->
            <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?php echo $_SESSION['type'] ?>">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['type']);
          ?>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</body>
</html>