<?php 
require 'config/db.php';

session_start();
error_reporting(0);

if (!isset($_SESSION['passport'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
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
	
	<title>View Your Profile</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .content{
          width:  100%;
          margin-top: 0px;
          margin-left: 250px;
      }

    
    </style>
</head>

<body>
<?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content">
        <section class=" profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Your Profile</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Profile</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>


        <?php 
             $userPassport = $_SESSION['passport'];
            $sql = "SELECT * FROM users WHERE passport=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $userPassport);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->num_rows;
            $stmt->close();
            if($row > 0)
            {
              while($row = $result->fetch_assoc())
            {  ?>
            <section class="user_profile inner_pages">
            <div class="container">
                <div class="user_profile_info gray-bg padding_4x4_40">
                
            <div class="dealer_info">
                <h5><?php echo htmlentities($row['fullname']);?></h5>
                <p><?php echo htmlentities($row['address']);?><br></p>
            </div>
                </div>
            </div>
            </section>

            <?php }} ?>
                    
        </div>
	</div>

	<!-- Loading Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous"></script>
</body>
</html> 
