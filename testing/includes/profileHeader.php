<?php session_start(); 
	$myvalue = $_SESSION['username'];
	$arr = explode(' ',trim($myvalue));
	$firstName= $arr[0]; // will print Test
?>

<div class="brand clearfix">
	<a href="userProfile.php" style="font-size: 20px;">Scooter Rental</a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<a href="#"><img src="Images/favicon.png" class="ts-avatar hidden-side" alt=""> <?php echo $firstName ?> <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php?logout='1'" >logout</a> </li>
				</ul>
			</li>
		</ul>
	</div>
