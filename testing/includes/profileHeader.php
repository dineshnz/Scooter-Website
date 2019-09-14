<?php 
	require 'config/db.php';
	session_start(); 
	$myvalue = $_SESSION['username'];
	$arr = explode(' ',trim($myvalue));
	$firstName= $arr[0]; // will print the first name of the logged user
	$requesterId = $_SESSION['id'];
?>
<style>
	.ts-account ul li:hover{
		-webkit-transition: all .3s ease-in-out;
		-webkit-transform: scale(1.05);
	}

	.dropdown-toggle::after {
	display:none;
}

.scrollable-menu {
    height: auto;
    max-height: 250px;
    overflow-x: hidden;
}

</style>


<div class="brand clearfix">
	<a href="userProfile.php" style="font-size: 20px;"><img class="imagelink" src="Images/Logo.png" height="40px" style="margin-left:20px; margin-top: 5px;" alt=""></a>  
	<a href="index.html" style="font-size: 20px;">Home</a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
		<li class="dropdown ts-account">
	   <a href="#" class="dropdown-toggle" id="dropdown01" style="height:60px" data-toggle="dropdown" >
	   <i class="fa fa-bell fa-lg" ></i>
	   <span  style="font-size:18px;"></span>
	   <?php
				$query = "SELECT * from `notifications` where `status` = 'unread' 
				AND `requesterId`= '$requesterId' order by `date` ASC";
				$result = $conn->query($query);
				$count = $result->num_rows;

                if($count > 0){
                ?>
                <span class="badge badge-danger"><?php echo $count; ?></span>
              <?php
                }
                    ?>
	</a>
       <ul class="dropdown-menu scrollable-menu" style="width: 300px;" >
	   <?php
                $query1 = "SELECT * from `notifications` where `requesterId`= '$requesterId' order by `date` DESC ";
				$result1 = $conn->query($query1);
				$rowcount = $result1->num_rows;
				
				
				if($rowcount > 0){
					while($row = $result1->fetch_assoc()){
                ?>
              <a style ="color:black; 
                         <?php
                            if($row['status']=='unread'){
                                echo "font-weight:bold; background: lightGray";
                            }
                         ?>
                         " class="dropdown-item" href="viewNotification.php?id=<?php echo $row['id'] ?>">
                <small><i><?php echo date('F j, Y, g:i a',strtotime($row['date'])) ?></i></small><br/>
                  <?php 
                  
                if($row['type']=='approved' || $row['type']=='rejected'){
                    echo ucfirst($row['notifierName']). " updated on your request<br> to view their vehicle.";
                }else if($row['type']=='viewProfile'){
                    echo ucfirst($row['notifierName'])." would like to view your profile.";
				}
				else if($row['type']=='acceptedProfile' || $row['type']=='rejectedProfile'){
                    echo ucfirst($row['notifierName'])." updated your<br> request for his/her profile.";
				}
				else if($row['type']=='pending'){
                    echo ucfirst($row['notifierName'])." would like to view your vehicle";
                }
                  
                  ?>
                </a>
              <div class="dropdown-divider"></div>
                <?php
                     }
                 }else{
                     echo "No Records yet.";
                 }
				    ?>
		   
	   </ul>
      </li>

			
			<li class="ts-account">
				<a href="#"><img src="Images/favicon.png" class="ts-avatar hidden-side" alt=""> <?php echo $firstName ?> <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="myPassword.php">Change Password</a></li>
					<li><a href="logout.php?logout='1'" >logout</a> </li>
				</ul>
			</li>

		</ul>
	</div>

	<script src="js/jquery-3.4.1.min.js" ></script>
<script>
		
// $(document).ready(function(){
 
//  function load_unseen_notification(view = '')
//  {
//   $.ajax({
//    url:"fetchNotification.php",
//    method:"POST",
//    data:{view:view},
//    dataType:"json",
//    success:function(data)
//    {
//     $('.dropdown-menu').html(data.notification);
//     if(data.unseen_notification > 0)
//     {
//      $('.count').html(data.unseen_notification);
//     }
//    }
//   });
//  }
 
//  load_unseen_notification();
 
 
 
//  $(document).on('click', '.dropdown-toggle', function(){
//   $('.count').html('');
//   load_unseen_notification('yes');
//  });
 
//  setInterval(function(){ 
//   load_unseen_notification();; 
//  }, 5000);
 
// });


// 	</script>

	
    


	