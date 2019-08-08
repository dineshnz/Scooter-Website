<!DOCTYPE html>
<?php

include("admin/conn.php");

$result = mysql_query("select * from cart");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

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

<!--search-->
<div id="nav">
    <div class="nav-con">
        <div class="name">Shopping Cart</div>
        <div class="search">
			<a href="list.php">Returns the list of items</a>
        </div>
    </div>
</div>
<!--end search-->

<div id="container">
    <div class="title">All goods</div>
	
		 <div class="head">
			<div class="message">Goods Message</div>
			<p class="price">Price</p>
			<div class="operate">Operate</div>
		</div>


<?php
	if($result != null){
		$price = 0;
		while($row = mysql_fetch_array($result)){
			echo '<div class="goods">';
			echo '<input type="checkbox"  value='.$row['cid'].'>';
			echo '<div class="image"><img src="images/'.$row['img'].'" alt=""></div>';
			echo '<div class="name"> '.$row['assetName'].'</div>';
			echo '<div class="desc">'.$row['timestamp'].$row['make'].'Prius<br>It is hybrid car</div>';
			echo '<div class="price">';
			echo '<p><span>Price:</span> <span style="font-weight: bold;font-size: 16px">$'.$row['price'].' </span></p>';
			echo '<p>Excludes On Road Costs</p>';
			echo '</div>';
			$price += $row['price'];
			?>
			
			<div class="delete">
			<a href="remove.php?cid=<?=$row['cid'] ?>" onclick="return confirm('确认删除吗？');">Delete</a>
			</div>
		<?php	
			echo '</div>';
		}
	}else{
		
		echo 'Shopping carts are temporarily out of stock';
	}
?>

	
    <div class="function">
        <p><input type="checkbox" onclick="checkAll(this)" id="all" /></p><p>Select All</p>
        <p><a href="" onclick="del()">Delete</a></p>
        <div class="button"><a href="" style="color: #fff">Pay</a></div>
        <p style="float: right;height: 50px">
            <span>Total Price（Excluding freight）：</span> <span style="color: #f40;font-size: 22px;font-weight: bold">￥</span> <span style="color: #f40;font-size: 22px;font-weight: bold"><?php echo $price; ?></span>
        </p>
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
	<script src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
	var arry =[];
	function del() {	
	if(!confirm('Are you sure')){
		return;
	}
	$("#container input[type='checkbox']").each(function(){
		//alert($(this).html())
		if($(this).prop("checked")){
			if(!isNaN($(this).val())){
				arry.push($(this).val());
			}
		}
	})
	$.ajax({
	   type: "POST",
	   url: "removes.php",
	   data: {
		   ids:arry.toString()
	   }
	});
	}
    function checkAll(obj){
		var isCheck = $(obj).prop("checked");
		$("input[type='checkbox']").prop("checked",isCheck);
	}
		
	</script>
<?php

$delete = 'delete * from cart  where cid ='.$arry;

?>
	
</body>
</html>