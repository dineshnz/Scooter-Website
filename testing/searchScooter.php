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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/style.css">
	
	
	<style>
		.main {
			width: 50%;
			margin: 50px auto;
		}

		/* Bootstrap 4 text input with search icon */

		.has-search .form-control {
			padding-left: 2.375rem;
		}

		.has-search .form-control-feedback {
			position: absolute;
			z-index: 2;
			display: block;
			width: 2.375rem;
			height: 2.375rem;
			line-height: 2.375rem;
			text-align: center;
			pointer-events: none;
			color: #aaa;
		}
		#targetDiv{
			margin-left: 200px;
		}

	</style>
	

</head>

<body>
	<?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">

			<form>
				<div class="main">
					<div class="input-group">
						
						<input type="text" class="form-control" id="searchInput" placeholder="Search scooter through passport number you may know" required>
						
						<div class="input-group-append">
							<button class="btn btn-secondary" id="searchBtn" type="button" onclick="validation()">
								<i class="fa fa-search"></i>
							</button>
						</div>
						
					</div>
					<span id="refErr" class="text-danger font-weight-bold"></span>

				</form>
			</div>
			

			<div id="targetDiv"></div> 
			
		</div>
	</div>

	

	<script type="text/javascript" src="js/showScooters.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html> 
