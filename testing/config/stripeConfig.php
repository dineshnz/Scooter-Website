<?php
    require_once 'stripe-php-master/init.php';

    $stripeDetails = array(
        "secretKey" => "sk_test_XejJD32y4F69B4q3lKnQO2qI00Cjg8zsHD",
        "publishableKey" => "pk_test_ryOO49LI3maIYmhohuV6jJIb00tzJQN1Sd"
    );

      // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey($stripeDetails['secretKey']);

?>