<?php
session_start();

require 'config/db.php';
//require_once 'emailController.php';
require_once 'newController.php';

$fullname = "";
$email = "";
$passport ="";
$address = "";
$license = "";
$errors = [];





// SIGN UP USER
if (isset($_POST['signup-btn'])) {
    $fullname = $_POST['fullname'];
$email = $_POST['email'];
$passport = $_POST['passport'];
$address = $_POST['address'];
$license = $_POST['license'];
    if (empty($_POST['fullname'])) {
        $errors['fullname'] = 'Username required';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email address is invalid";
    }
  
    
    if (empty($_POST['passport'])) {
        $errors['passport'] = 'Passport Number required';
    }
    if (empty($_POST['address'])) {
        $errors['address'] = 'Address required';
    }
    if (empty($_POST['license'])) {
        $errors['license'] = 'Driver License Number required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    if (empty($_POST['confirmpassword'])) {
        $errors['confirmpassword'] = 'Confirm password required';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['confirmpassword']) {
        $errors['passwordConf'] = 'The two passwords do not match';
    }

    
   
    

    // Check if email already exists
    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
   
    $userCount = $result->num_rows;
    $stmt->close();

    if ($userCount > 0) {
        $errors['email'] = "Email already exists";
    }

    //check if there duplicate passport
    $passportQuerry = "SELECT * FROM users WHERE passport=? LIMIT 1";
    $stmt = $conn->prepare($passportQuerry);
    $stmt->bind_param('s', $passport);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $passportCount = $result1->num_rows;
    $stmt->close();

    if ($passportCount > 0) {
        $errors['passport'] = "passport number already exists";
    }

    if (count($errors) === 0) {
        $token = bin2hex(random_bytes(50)); // generate unique token
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
        $verified = false;
        
        $sql = "INSERT INTO users (fullname, email, passport, address, driverLicense, verified, token, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssbss', $fullname, $email, $passport, $address, $license, $verified, $token, $password);

        $resultSql = $stmt->execute();

        if($resultSql){
            //login user when registered
            // $user_id = $conn->insert_id;
            // $_SESSION['id'] = $user_id;
            // $_SESSION['fullname'] = $fullname;
            // $_SESSION['email'] = $email;
            // $_SESSION['passport'] = $passport;
            // $_SESSION['address'] = $address;
            // $_SESSION['driverLicense'] = $license;
            // $_SESSION['verified'] = $verified;

            //sendVerificationEmail($email, $token);
            sendVerification($email, $token);

            $msg = "You have been registered! Please verify your email";

            //set flash messages
            $_SESSION['message'] = 'You have been registered! Please verify your email';
            $_SESSION['alert-class'] = 'alert-success';
            header('location: signup.php');
            exit();



        }else{
            $errors['db_error'] = "Database Error: Failed to register";
            //$_SESSION['error_msg'] = "Database error: Could not register user";
        }

        
    }
}

// LOGIN
if (isset($_POST['login-btn'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username or email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM users WHERE passport=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();

                if($user['verified'] ==0){
                    $errors['verify-email'] = "Please Verify your email to be able to log in";
                }else{
                    $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['passport'] = $user['passport'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['license'] = $user['driverLicense'];
                $_SESSION['userLevel'] = $user['userLevel'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: userProfile.php');
                exit(0);
                }

                
            } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}

//logout user
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['fullname']);
    unset($_SESSION['passport']);
    unset($_SESSION['address']);
    unset($_SESSION['driverLicense']);
    header('location: login.php');
    exit();
}


//verify user function
function verifyUser($token){
    global $conn;
    $sql = "SELECT * FROM users where token = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->num_rows;
    $stmt->close();


    if($row > 0){
        $user = mysqli_fetch_assoc($result);
        $update_query = "UPDATE users SET verified=1 WHERE token ='$token'";

        if (mysqli_query($conn, $update_query)){
            //log user in
            $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['passport'] = $user['passport'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['license'] = $user['license'];

                $_SESSION['verified'] = 1;
                $_SESSION['message'] = 'Your Email was successfully verified! Please login and enjoy the website';
                $_SESSION['type'] = 'alert-success';
                header('location: login.php');
                exit(0);

        }else{
            echo "user not found";
        }
    }
}

//if user clicks on the forgot password button
if (isset($_POST['forgot-password'])){
    $email = $_POST['email'];

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email address is invalid";
    }

    if(count($errors) == 0){
        //we have to send the link to user email which is unique to that user so 
        //we use token of that user
        $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
   
    $stmt->close();
    $token = $user['token'];
    
    sendPasswordResetLink($email, $token);
    $_SESSION['message'] = 'An email has been sent to your email address with a link to reset you password.
     Please check your email';
     $_SESSION['type'] = 'alert-success';
     header('location: forgot_password.php');
     exit();

    
    }
}

//if user clicks on reset password button
if(isset($_POST['reset-password-btn'])){
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    if (empty($_POST['passwordConf'])) {
        $errors['passwordConf'] = 'Confirm password required';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'The two passwords do not match';
    }

    $password = password_hash($password, PASSWORD_DEFAULT); //encrypt password
    $email = $_SESSION['email'];

    if(count($errors) == 0){
        $sql = "UPDATE users SET password = '$password' WHERE email = '$email'"; 
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location: login.php');
            exit(0);
        }
    }
}

function resetPassword($token){
    global $conn;
    $sql = "SELECT * FROM users where token = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['email'] = $user['email'];
    header('location: reset_password.php');


}

//listing the scooter in database
if(isset($_POST['submit']))
  {
$vehicletitle=$_POST['vehicletitle'];
$brand=$_POST['vehiclebrand'];
$vehicleoverview=$_POST['vehicalorcview'];
$priceperday=$_POST['priceperday'];
$fueltype=$_POST['fueltype'];
$modelyear=$_POST['modelyear'];
$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$vimage4=$_FILES["img4"]["name"];
$vimage5=$_FILES["img5"]["name"];
$antilockbrakingsys=$_POST['antilockbrakingsys'];
$brakeassist=$_POST['brakeassist'];
$leatherseats=$_POST['leatherseats'];
move_uploaded_file($_FILES["img1"]["tmp_name"],"Images/uploadedImages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"Images/uploadedImages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"Images/uploadedImages/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"Images/uploadedImages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"Images/uploadedImages/".$_FILES["img5"]["name"]);


$sql = "INSERT INTO tblscooters(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,
Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AntiLockBrakingSystem,BrakeAssist,LeatherSeats) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


        $stmt = $conn->prepare($sql);
		$stmt->bind_param('sssisisssssiii', $vehicletitle, $brand, $vehicleoverview, $priceperday, $fueltype, $modelyear, 
		$vimage1,$vimage2,$vimage3,$vimage4,$vimage5, $antilockbrakingsys, $brakeassist, $leatherseats);

        $resultSql = $stmt->execute();


if($resultSql)
{
$msg="Vehicle posted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}


	?>



?>