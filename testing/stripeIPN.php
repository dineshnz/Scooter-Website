<?php
  require_once 'config/stripeConfig.php';
  require_once 'config/db.php';
session_start();
$price = $_SESSION['price'];
$paidById = $_SESSION['id'];
$paidToId = $_POST['OwnerId'];
$paidStatus = 1;



// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
$vehicleId =$_POST['id'];
$price = $_SESSION['price'];
$returnStatus = 0;





$charge = \Stripe\Charge::create([
    'amount' => $price*100,
    'currency' => 'nzd',
    'description' => 'Example charge',
    'source' => $token,
]);


global $conn;
    //inserting data to the transaction table 
    $sql = "INSERT INTO transactions (amount, paidById, paidToId, vehicleId, paidStatus, returnStatus)
     VALUES (?, ?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiiiii', $price, $paidById, $paidToId, $vehicleId, $paidStatus, $returnStatus);

    $resultSql = $stmt->execute();

    if($resultSql){
      //set flash messages
      $_SESSION['message'] = 'Thank you for your payment. Enjoy your ride';
      $_SESSION['alert-class'] = 'alert-success';
      header('location: successVehiclePayment.php');
      exit();

  }else{
      $errors['db_error'] = "Database Error: Failed to register";
      //$_SESSION['error_msg'] = "Database error: Could not register user";
  }
   
?>