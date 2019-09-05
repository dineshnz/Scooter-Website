<?php
//premium plan id: plan_FWQBL2Tt3IJs2d
  require_once 'config/stripeConfig.php';
  require_once 'config/db.php';

session_start();
$passport = $_SESSION['passport'];


$products = array(
    "sids" => ["1","2"],
    "1" => "plan_FkeoiJRbHTlgEj",
    "2" => "plan_FkemmxPswGWnoD"
);

if(!isset($_GET['sid']) || !in_array($_GET['sid'], $products['sids']) || !isset($_POST['stripeToken']) || !isset($_POST['stripeEmail'])){
    header('location: userProfile.php');
    exit();
}



// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
$productID =$_GET['sid'];



$customer = \Stripe\Customer::create([
    'email' =>$email,
    'source' =>$token
]);

\Stripe\Subscription::create([
    "customer" => $customer->id,
    "items" => [
      [
        "plan" => $products[$productID],
      ],
    ]
  ]);

      
  global $conn;
  
    $sql = "SELECT * FROM users where passport = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $passport);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->num_rows;
    $stmt->close();


    if($row > 0){
        $user = mysqli_fetch_assoc($result);
        $update_query = "UPDATE users SET userLevel = '$productID' WHERE passport = '$passport'";

        if (mysqli_query($conn, $update_query)){
            //log user in

                if($productID ==1){
                    $subscription = "Basic Membership";
                }
                if($productID ==2){
                    $subscription = "Prime Membership";
                }
                
           
                $_SESSION['userLevel'] = $productID;
                $_SESSION['message'] = "$passport you have successfully upgraded your account to $subscription Account. ";
                $_SESSION['type'] = 'alert-success';
                header('location: successPayment.php');
                exit(0);

        }else{
            echo "user not found";
        }
    }

   
?>