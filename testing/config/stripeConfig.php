<?php
    require_once 'stripe-php-master/init.php';

    $stripeDetails = array(
        "secretKey"      => "sk_test_hLmKJaaxCjcWVz4vdiKQstIt00KAJIO8ZU",
         "publishableKey" => "pk_test_qwyBT1RyIMuwU8OlVy5gYh3Z00URvI8hFw",
    );

      // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey($stripeDetails['secretKey']);

?>