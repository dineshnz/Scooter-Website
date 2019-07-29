<?php require_once 'controllers/authController.php'?>
<?php require_once 'config/stripeConfig.php';?>

<?php 
	error_reporting(0);

  if (!isset($_SESSION['passport'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['passport']);
    header("location: login.php");
  }

  $userLevel = $_SESSION['userLevel'];
?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Post a scooter</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <style>
      .content{
          width:  75%;
          margin-top: 0px;
          margin-left: 280px;
      }  
    
    </style>

</head>

<body>
	<?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
  
  <?php if($userLevel == 0){ ?>
            <div class="content">
        <div class="jumbotron">
  <h1 class="display-4">Hello, <?php echo $_SESSION['username'] ?></h1>
  <hr>
  <p class="lead">Since you have not chosen any subscription plan, You only have access to your profile.
      Please upgrade to one of the subscription plan below to enjoy our website. 
  </p>
</div>

         <!-- creating subscription pages -->
  <?php include 'subscription.php' ?>
</div>

<?php }?>

<?php if($userLevel == 1){ ?>
            <div class="content">
        <div class="jumbotron">
  <h1 class="display-4">Hello, <?php echo $_SESSION['username'] ?></h1>
  <hr>
  <p class="lead"> Upgrade to the premium and get privilige to be able to rent your own scooter. 
  </p>
</div>

         <!-- creating subscription pages -->
  <?php include 'subscription1.php' ?>
</div>

<?php }?>

<?php if($userLevel == 2){ ?>
            <div class="content">
        <div class="jumbotron">
  <h1 class="display-4">Hello, <?php echo $_SESSION['username'] ?></h1>
  <hr>
  <p class="lead"> Enjoy the privilege to be able to list and rent scooters. If you think you would only like to rent the scooter, 
    please update your membership 
  </p>
</div>

         <!-- creating subscription pages -->
  <?php include 'subscription2.php' ?>
</div>

<?php }?>

</div>


	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html> -->
