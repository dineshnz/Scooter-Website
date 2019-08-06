<!--CHECK user is logged in-->
<?php require_once 'controllers/authController.php'?>

<?php 
error_reporting(0);

    if (!isset($_SESSION['passport'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['passport']);
        header("location: login.php");
    }
?>

<?php
//CONNECT to DB using config/db.php
require 'config/db.php';
error_reporting(0);
$mysqli = new mysqli("localhost", "DB_USER", "DB_PASS", "DB_NAME");
//on this page we make the DB connection
//$connect = new PDO('mysql:host=localhost;dbname=scootera', 'root', '');
//after DB connection, define 3 variables
$error = '';
$comment_name = '';
$comment_content = '';
    //CHECK if comment_name is empty or not
    if(empty($_POST["comment_name"])){
        $error .= '<p class="text-danger">Name is required</p>';
    }else{
        $comment_name = $_POST["comment_name"];
    }
    //CHECK if comment_content is empty or not
    if(empty($_POST["comment_content"])){
        $error .= '<p class="text-danger">Comment is required</p>';
    }else{
        $comment_content = $_POST["comment_name"];
    }
    //IF this is true then there is no validation error and it will execute the block below
    if($error == ''){
        $query = $mysqli->("INSERT INTO tbl_comment(parent_comment_id, comment, comment_sender_name) VALUES (:parent_comment_id, :comment, :comment_sender_name)");
        //below prepares $query for execution
        $statement = $connect->prepare($query);
        //execute method with value, pass in an array format. This method will execute INSERT query
        $statement->execute(
            array(
                ':parent_comment_id'    => '0',
                ':comment'              => $comment_content,
                ':comment_sender_name'  => $comment_name
            )
            $error = '<label class-"text-success">Comment Added</label>';
        );
    }

    $data = array(
        'error' => $error
    );

    //lastly send the data to AJAX. converts to a string and sends to AJAX
    echo json_encode($data);
?>