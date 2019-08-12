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

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My assets</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/style.css">
        
        <style>

   .box
   {
    width:95%;
    padding:10px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:10px;
   }

  </style>
 </head>
 <body>
 <?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
  
        <?php 
  
   $myid = $_SESSION['id'];
     $id = $_GET['id'];
    $query ="UPDATE `notifications` SET `status` = 'read' WHERE `id` = $id AND `requesterId`=$myid;";
    $result = $conn->query($query);
    $query1 = "SELECT * from `notifications` where `id` = '$id' AND `requesterId`=$myid;;";
    $result1 = $conn->query($query1);
    $rowCount = $result1->num_rows;
    if($rowCount > 0){
       while($i=$result1->fetch_assoc()){
            if($i['type']=='approved' || $i['type']=='rejected'){?>
            <div class="card-deck">
    
                <div class="card" style="background-color: lightblue; margin-left: 45px; margin-right: 45px;">
                <div class="card-header text center"><h1>Response</h1> </div>
                <div class="card-body">
                <?php echo ucfirst($i['message'])." by ". ucfirst($i['notifierName'])." with passport number ".$i['notifierPassport']."<br> Please check your status"; 
                   
                ?>
                    
        </div>
        </div>
     <!--End of the cards-->
 
  <!--target div for the table--> 
</div>


<?php
    }
    else if($i['type']=='pending'){?>
    <div class="card-deck">
    
    <div class="card" style="background-color: lightblue; margin-left: 45px; margin-right: 45px;">
    <div class="card-header text center"><h1>Response</h1> </div>
    <div class="card-body">
    <?php echo ucfirst($i['notifierName'])." would like to view one of your vehicle";
     
    ?>

</div>
</div>
    </div>
    <?php }
    else{?>
            <div class="card-deck">
    
    <div class="card" style="background-color: lightblue; margin-left: 45px; margin-right: 45px;">
    <div class="card-header text center"><h1>Response</h1> </div>
     
      <div class="card-body">
      <?php  echo ucfirst($i['notifierName'])." would like to view your profile. Please go to your pending request
                page to view the requests."; ?>

    </div>
    </div>
     <!--End of the cards-->
 
  <!--target div for the table--> 
</div>
           <?php    
            }
        }
    }
    
?><br/>
<a href="userProfile.php" type="button" class="btn btn-primary" style="margin-left:50px">Go Back</a>


        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
 </body>
</html>




