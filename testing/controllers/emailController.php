<?php   
    require_once './vendor/autoload.php';
    require_once 'config/const.php';

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'SSl'))
      ->setUsername(EMAIL)
      ->setPassword(PASSWORD)
    ;
    
    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
    
    

    function sendVerificationEmail($userEmail, $token){
        //make mailer global
        global $mailer;
        $body= '<!DOCTYPE html>
        <html lang="en">
    
        <head>
          <meta charset="UTF-8">
          <title>Test mail</title>
          <style>
            .wrapper {
              padding: 20px;
              color: #444;
              font-size: 1.3em;
            }
            a {
              background: #592f80;
              text-decoration: none;
              padding: 8px 15px;
              border-radius: 5px;
              color: #fff;
            }
          </style>
        </head>
    
        <body>
          <div class="wrapper">
            <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
            <a href="https://localhost/scooter-website/testing/confirm.php?token=' . $token . '">Verify Email!</a>
          </div>
        </body>
    
        </html>';
        // Create a message
    $message = (new Swift_Message('Verify you email address'))
    ->setFrom(EMAIL)
    ->setTo($userEmail)
    ->setBody($body, 'text/html')
    ;
  
    // Send the message
     $result = $mailer->send($message);
    }

   function sendPasswordResetLink($email, $token){
      //make mailer global
      global $mailer;
      $body= '<!DOCTYPE html>
      <html lang="en">
  
      <head>
        <meta charset="UTF-8">
        <title>Test mail</title>
        <style>
          .wrapper {
            padding: 20px;
            color: #444;
            font-size: 1.3em;
          }
          a {
            background: #592f80;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: #fff;
          }
        </style>
      </head>
  
      <body>
        <div class="wrapper">
          <p>
            Hello there,

            Please click on the link below to reset your password.
          
          </p>
          <a href="https://localhost/scooter-website/testing/confirm.php?password-token=' . $token . '">Reset Password!</a>
        </div>
      </body>
  
      </html>';
      // Create a message
  $message = (new Swift_Message('Reset your password!'))
  ->setFrom(EMAIL)
  ->setTo($email)
  ->setBody($body, 'text/html')
  ;

  // Send the message
   $result = $mailer->send($message);
  } 
   



    
?>