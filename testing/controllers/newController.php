<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/SMTP.php';
    require_once 'PHPMailer/Exception.php';

    

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);



function sendVerification($email, $token){
    global $mail;

    try {
        //Server settings
        $mail->SMTPDebug = 1;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'scootera.wyzint@gmail.com';                     // SMTP username
        $mail->Password   = 'wyzint1234';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('scootera.wyzint@gmail.com', 'WYZ');
        $mail->addAddress($email);     // Add a recipient
       
    
       
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Verify Your Email!';
        $mail->Body    = 'Please click on the link below to verify your email. <br><br>
        <a href="https://localhost/scooter-website/testing/confirm.php?token=' . $token . '">Verify Email!</a>';
       
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function sendPasswordResetLink($email, $token){
    global $mail;

    try {
        //Server settings
        $mail->SMTPDebug = 1;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'scootera.wyzint@gmail.com';                     // SMTP username
        $mail->Password   = 'wyzint1234';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('scootera.wyzint@gmail.com', 'WYZ International');
        $mail->addAddress($email);     // Add a recipient
       
    
       
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reset you password';
        $mail->Body    = 'Please click on the link below to reset your password. <br><br>
        <a href="https://localhost/scooter-website/testing/confirm.php?password-token=' . $token . '">Reset Password!</a>';
       
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

    
    

    // function sendVerification($email, $token){
    //     global $mail;

    //     $mail = new PHPMailer();
        
    // $mail->setFrom('hello@scootera.wpengine.com');
    // $mail->addAddress($email);
    // $mail->Subject = "Please verify your email";

    // $mail->isHTML(true);
    
    // $mail->Body = "
    // Please click on the link below to verify your email. <br><br>

    //   <a href="https://localhost/scooter-website/testing/confirm.php?token=' . $token . '">Verify Email!</a>";

    // $mail->send();
    // }

    

?>