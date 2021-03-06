<?php require_once 'controllers/authController.php'?>

<?php 
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
//if the user level is less than 2 then user will not be able to visit this page
if (($_SESSION['userLevel']) !=2) {
	$_SESSION['msg'] = "You are not allowed to visit url you entered";
	$_SESSION['type'] = 'alert-danger';
	header('location: userProfile.php');
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
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
	<script src="js/loadNotifications.js"></script>
	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		.succWrap{
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
	</style>

</head>

<body>
	<?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper" style="margin-top: 60px">
			<div class="container-fluid">
				
				<?php
				$license = $_SESSION['license'];
				
				?>

				<div class="row">
					<div class="col-md-12">
						
						<h2 class="page-title">Post A Vehicle</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
									else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
										<form method="post"  class="form-horizontal" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="vehicletitle" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">Vehicle Brand<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="vehiclebrand" class="form-control" required>
												</div>
											</div>
											
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Vehical Overview<span style="color:red">*</span></label>
												<div class="col-sm-10">
													<textarea class="form-control" name="vehicalorcview" rows="3" title="basic overview of the scooter" required></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="number" name="priceperday" class="form-control" pattern="[0-9]" title="price must be numbers" required>
												</div>
												<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="selectpicker" name="fueltype" required>
														<option value=""> Select </option>

														<option value="Petrol">Petrol</option>
														<option value="Diesel">Diesel</option>
														<option value="CNG">CNG</option>
													</select>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="number" name="modelyear" class="form-control"  title="year must be numbers" required>
												</div>
											</div>
											<div class="hr-dashed"></div>


											<div class="form-group">
												<div class="col-sm-12">
													<h4><b>Upload Images</b></h4>
												</div>
											</div>


											<div class="form-group">
												<div class="col-sm-4">
													Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
												</div>
												<div class="col-sm-4">
													Image 2<span style="color:red">*</span><input type="file" name="img2" >
												</div>
												<div class="col-sm-4">
													Image 3<span style="color:red">*</span><input type="file" name="img3" >
												</div>
											</div>


											<div class="form-group">
												<div class="col-sm-4">
													Image 4<input type="file" name="img4" >
												</div>
												<div class="col-sm-4">
													Image 5<input type="file" name="img5">
												</div>

											</div>
											<div class="hr-dashed"></div>									
										</div>
									</div>
								</div>
							</div>
							

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Accessories</div>
										<div class="panel-body">


											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
														<label for="antilockbrakingsys"> AntiLock Braking System </label>
													</div></div>
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="brakeassist" name="brakeassist" value="1">
														<label for="brakeassist"> Brake Assist </label>
													</div>
												</div>

												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="leatherseats" name="leatherseats" value="1">
														<label for="leatherseats"> Leather Seats </label>
													</div>
												</div>
											</div>




											<div class="form-group">
												<div class="col-sm-8 offset-sm-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
						
						

					</div>
				</div>
				
				

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html> -->
