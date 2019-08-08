<?php session_start(); 
	$myvalue = $_SESSION['username'];
	$arr = explode(' ',trim($myvalue));
	$firstName= $arr[0]; // will print the first name of the logged user
?>
<style>
	.ts-account ul li:hover{
		-webkit-transition: all .3s ease-in-out;
		-webkit-transform: scale(1.05);
	}

</style>

<div class="brand clearfix">
	<a href="userProfile.php" style="font-size: 20px;"><img class="imagelink" src="Images/Logo.png" height="40px" style="margin-left:20px; margin-top: 5px;" alt=""></a>  
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
