<?php
require 'config/db.php';
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


    //get all the inputs
$userId = $_POST['userId'];

$sql =" SELECT * from userhistory h join users u on h.userId = u.id where h.userId=?";
$query = $conn -> prepare($sql);
$query->bind_Param('i', $userId);
$query->execute();
$results=$query->get_result();
$count = $results->num_rows;


$cnt=1;
if($count > 0)
{
    while($row = $results->fetch_assoc())
        {?>
            <!-- Displaying the results in the card format -->
            <div class="card text-center">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    <h5 class="card-title">Name of the person: <?php echo $row['fullname'] ?></h5>
                    <p class="card-text">Response from owner: <?php echo $row['ownerResponse'] ?></p>

                </div>
                <div class="card-footer text-muted">
                    Date of review: <?php echo $row['createdOn'] ?>
                </div>
            </div>
            <hr>

            <?php
        }
    }
    ?>  



