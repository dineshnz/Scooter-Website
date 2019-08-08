<!DOCTYPE html>

<?php
session_start();
include("admin/conn.php");
?>
<?php

	if($_GET['condition'] ==1){
		$condition = " timestamp";
	}
	if($_GET['condition'] ==2){
		$condition = " price";
	}
	if($_GET['order'] ==1){
		$order = " asc";
	}
	if($_GET['order'] ==2){
		$order = " desc";
	}
$result = mysql_query('select * from asset order by'.$condition.$order);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品列表</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/list.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-dark  fixed-top">
    <a class="navbar-brand" href="index.html"><img class="imagelink" src="images/Logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">

            <li class="nav-item ">
                <a class="nav-link" href="#">How we work</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="#">About Us</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
			<li><a class ="nav-link" href="cart.php">Shopping Cart <img src ="Images/cart.png" style="width:18px; height:18px "></a></li>
            <li><a class="nav-link" href="signup.php">SignUp <i class="fa fa-user-plus"></i></a></li>
            <li><a class="nav-link" href="login.php">Login <i class="fa fa-user"></i></a></li>
        </ul>
    </div>
</nav>

<div id="search">
	
  <form class="submit" action="list2.php" method="post">
        <input type="text" placeholder="car" name="assetName" id="assetName" >
		<input type="button" value="Seach">
  
  </form>

</div>


<div id="container">

    <div class="left">
		
		<div>
      
	
		Condition: <input type="text" name="condition" value="<?php echo $condition; ?>" style ="width: 100px;" disabled="disabled"><br/>
		Sort Order:<input type="text" name="condition" value="<?php echo $order; ?>" style ="width: 50px;" disabled="disabled"><br/>
		<a href="list.php">Return List</a>
					
			
	
       
		
		</div>
       
    </div>
    <div class="right">
<div class="goods-box">
<?php
	while($row = mysql_fetch_array($result)){
		echo '<div class="goods">';
		echo '<div class="image"><img src="images/'.$row['img'].'"></div>';
		echo '<div class="message">';
		echo '<div class="info">';
		echo '<p>'.$row['assetName'].'</p>';
		echo '<p class="name">'.$row['timestamp'].'</p>';
		echo '<p style="font-weight: bold">'.$row['make'].'</p>';
		echo '<p>'.$row['status'].'</p>';
		
?>
		<div class="button">
			<strong><a href="cart.php?assetID=<?=$row['assetID'] ?>" style="color:white">Add to Cart</a></strong>
		</div>
		
<?php
		
		echo '</div>';
		echo '<div class="price">';
		echo '<p><span>Or near offer</span> <span style="font-weight: bold;font-size: 16px">$'.$row['price'].' </span></p>';
		echo '<p>Excludes On Road Costs</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	?>		
		
		</div>
</div>
</div>




<footer class="page-footer font-small mdb-color pt-4">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

        <!-- Footer links -->
        <div class="row text-center text-md-left mt-3 pb-3">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">WYZ international</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum modi, sunt! Alias ex quaerat
                    sequi?</p>
            </div>
            <!-- Grid column -->

            <hr class="w-100 clearfix d-md-none">


            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
                <p>
                    <a href="#!">About Us</a>
                </p>
                <p>
                    <a href="#!">FAQs</a>
                </p>
                <p>
                    <a href="#!">Privacy</a>
                </p>
                <p>
                    <a href="#!">Terms of use</a>
                </p>
            </div>


            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                <p>
                    <i class="fas fa-home mr-3"></i>Auckland, 1010, NZ </p>
                <p>
                    <i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
                <p>
                    <i class="fas fa-phone mr-3"></i> + 64 021 111 111</p>

            </div>
            <!-- Grid column -->


        </div>

    </div>
    <!-- Footer links -->

    <hr>
    <div class="footer-bottom">
        <span>© 2019 Copyright:</span><strong>WYZ International. All Rights Reserved</strong>
    </div>
    <!-- Grid row -->


    <!-- Footer Links -->

</footer>
</body>
</html>