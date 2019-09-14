<!-- this page displays success message when user pays for a scooter while renting that -->
<!-- Display messages -->
<?php session_start();
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
    <title>Thank you page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .col-md-12{
            border: 1px solid gray;
            border-radius: 5px;
        }

        
    </style>
</head>
<body>
    <?php include('includes/profileHeader.php');?>
    <div class="ts-main-content">
       <?php include('includes/leftbar.php');?>
       <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
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
               <a href="userProfile.php" class="btn btn-success" style="margin-left: 300px">Go to dashboard</a>
           </div>
       </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
crossorigin="anonymous"></script>
</body>
</html>