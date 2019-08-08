<?php
  require_once 'config/stripeConfig.php';
session_start();
$price = $_SESSION['price'];



// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
$productID =$_POST['id'];
$price = $_SESSION['price'];





$charge = \Stripe\Charge::create([
    'amount' => $price*100,
    'currency' => 'nzd',
    'description' => 'Example charge',
    'source' => $token,
]);


   
?>