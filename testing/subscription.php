<!-- controller to handle newly registered users to the website
this page will provide user with option to selece basic user membership plan and super membership plan -->
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

$email = $_SESSION['email'];

?>
<style>
   .card{
       width: 300px;
   }

   .first{
       background: lightblue;
   }

   .second{
       background: yellow;
   }
   .card:hover{
       -webkit-transform: scale(1.05);
       -moz-transform: scale(1.05);
       -ms-transform: scale(1.05);
       -o-transform: scale(1.05);
       transform:scale(1.05);

       -webkit-transition: all .3s ease-in-out;
       -moz-transition: all .3s ease-in-out;
       -ms-transition: all .3s ease-in-out;
       -o-transition: all .3s ease-in-out;
       transition:all .3s ease-in-out;
   }
   .price{ font-size: 72px; text-align: center;}
   .currency { 
    font-size: 25px;
    position: relative;
    top: -35px;

}

.type{
    text-align: center;
}

.list-group-item{
    border: 0px;
    padding: 5px;
    text-align: center;
}

</style>
<div class="container">
    <div class="row">
        
     <div class="col-md-6">
         <div class="card">
            <div class="card-header first">
             <h1 class="type">Basic User</h1>
         </div>
         <div class="card-header first">
            <h1 class="price"><span class="currency">$</span>9</h1>
            <h6 class="type">per month</h6>
        </div>
        <div class="card-body">
            
            <ul class="list-group">
                <li class="list-group-item">Partial access</li>
                <li class="list-group-item">Search Scooters</li>
                <li class="list-group-item">Rent Scooters</li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <form action="subscriptionProcess.php?sid=1" method="POST">
                
                <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key=<?php echo $stripeDetails['publishableKey'] ?>
                data-amount="900"
                data-name=  "Basic User"
                data-description= "Membership"
                data-email = <?php echo $email ?>
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="nzd">
            </script>
        </form>
    </div>
</div>
</div>
<div class="col-md-6">
 <div class="card">
    <div class="card-header second">
     <h1 class="type">Premium User</h1>
 </div>
 <div class="card-header second">
    <h1 class="price"><span class="currency">$</span>19</h1>
    <h6 class="type">per month</h6>
</div>
<div class="card-body">
    
    <ul class="list-group">
        <li class="list-group-item">Full access</li>
        <li class="list-group-item">Search Scooters</li>
        <li class="list-group-item">Rent Scooters</li>
        <li class="list-group-item">List Scooters for rent</li>
    </ul>
</div>
<div class="card-footer d-flex justify-content-center">
    <form action="subscriptionProcess.php?sid=2" method="POST">
        
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key=<?php echo $stripeDetails['publishableKey'] ?>
        data-amount="1900"
        data-name=  "Premium User"
        data-description= "Membership"
        data-email = <?php echo $email ?>
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="nzd">
    </script>
</form>
</div>
</div>
</div>

</div>


</div>
