<!-- this page displays the detailed description of the selected vehicle
Also, user and owner can comment and reply on this page regarding the selected scooter -->
<?php 
session_start();
error_reporting(0);
//if user is not logged in then redirect user to login page
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
require 'config/db.php';
require_once 'config/stripeConfig.php';

  //COMMENTING - variable for userID
$id = $_SESSION['id'];
$vid = $_GET['vhid'];

//FUNCTION to createCommentRow
function createCommentRow($data) {
    global $conn;

    $response = '
            <div class="comment">
                <div class="user">'.$data['fullname'].' <span class="time">'.$data['createdOn'].'</span></div>
                <div class="userComment">'.$data['comment'].'</div>
                <div class="reply"><a href="javascript:void(0)" data-commentID="'.$data['id'].'" onclick="reply(this)">REPLY</a></div>
                <div class="replies">';

    $sql = $conn->query("SELECT replies.id, fullname, comment, DATE_FORMAT(replies.createdOn, '%Y-%m-%d') AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id WHERE replies.commentID = '".$data['id']."' ORDER BY replies.id DESC LIMIT 1");
    while($dataR = $sql->fetch_assoc())
        $response .= createCommentRow($dataR);

    $response .= '
                        </div>
            </div>
        ';

    return $response;
}
  //COMMENTING - GET ALL THE COMMENTS
if(isset($_POST['getAllComments'])){
  $start = $conn->real_escape_string($_POST['start']);
  $response = "";
    //QUERY to get basic info - userName, date and comment. 
    //NEED to use a JOIN to get the UserID
    //LIMIT $start to 20 for each iteration
  $sql = $conn->query("SELECT comments.id, fullname, comment, DATE_FORMAT(comments.createdOn, '%Y-%m-%d') AS createdOn FROM comments INNER JOIN tblscooters ON comments.vID = tblscooters.vid ORDER BY comments.id DESC LIMIT $start, 20");
  while($data = $sql->fetch_assoc())
      //CREATE a FUNCTION to create a row: createCommentRow(), because the function will be used multiple times
    $response .= createCommentRow($data);
  exit($response);
}
  //COMMENTING - addComment TO DB
if(isset($_POST['addComment'])){
  $comment = $conn->real_escape_string($_POST['comment']);
  $isReply = $conn->real_escape_string($_POST['isReply']);
  $commentID = $conn->real_escape_string($_POST['commentID']);
  $vehicleID = $conn->real_escape_string($_POST['vehicleID']);

  echo "Vehicle ID: ", $vehicleID;

  if ($isReply != 'false') {
      $conn->query("INSERT INTO replies (comment, commentID, userID, createdOn, vID) VALUES ('$comment', '$commentID', '$id', NOW(),  '$vehicleID' )");
      $sql = $conn->query("SELECT replies.id, fullname, comment, DATE_FORMAT(replies.createdOn, '%Y-%m-%d') AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id ORDER BY replies.id DESC LIMIT 1");
  }else{
    $conn->query("INSERT INTO comments(userID, comment, createdOn, vID) VALUES('$id', '$comment', NOW(), '$vehicleID') ");
      //SET LIMIT to 1 so we get only the latest comment
    $sql = $conn->query("SELECT comments.id, fullname, comment, DATE_FORMAT(comments.createdOn, '%Y-%m-%d') AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id ORDER BY comments.id DESC LIMIT 1");
  }

  $data = $sql->fetch_assoc();
  exit(createCommentRow($data));
}
  //GET COMMENTS FROM THE DATABASE TO DISPLAY
$sqlNumComments = $conn->query("SELECT id FROM comments");
$numComments = $sqlNumComments->num_rows;

//RATING
    if (isset($_POST['save'])) {
        $uID = $conn->real_escape_string($_POST['uID']);
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;

        if (!$uID) {
            $conn->query("INSERT INTO stars (rateIndex) VALUES ('$ratedIndex')");
            $sql = $conn->query("SELECT id FROM stars ORDER BY id DESC LIMIT 1");
            $uData = $sql->fetch_assoc();
            $uID = $uData['id'];
        } else
            $conn->query("UPDATE stars SET rateIndex='$ratedIndex' WHERE id='$uID'");

        exit(json_encode(array('id' => $uID)));
    }

    $sql = $conn->query("SELECT id FROM stars");
    $numR = $sql->num_rows;

    $sql = $conn->query("SELECT SUM(rateIndex) AS total FROM stars");
    $rData = $sql->fetch_array();
    $total = $rData['total'];

    $avg = $total / $numR;
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Scooter Detail</title>
  <!-- Plug in for rating star - font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Sandstone Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/purple.css" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="css/owl.transitions.css" type="text/css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css" type="text/css">
  <link href="css/bootstrap-slider.min.css" rel="stylesheet">
  <link href="css/owl.carousel.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <style>
    .comment{
      margin-bottom: 20px;
    }
    .page-wrapper{
      margin-left: 20px;
      max-width: 95%;
    }
    .content{
      width:  75%;
      margin-top: 100px;
      margin-left: 260px;
    }
    .user{
      font-weight: bold;
      color: black;
      font-size: 15px;
    }
    .time, .reply{
      font-size: 15px;
      color: gray;
      font-weight: bold;
    }
    .userComment{
      color: black;
      font-size: 18px;
    }
    .replies .comment{
      margin-top: 20px;
    }
    .replies {
      margin-left: 20px;
    }
  </style>
</head>
<body>
  <?php include('includes/profileHeader.php'); ?>
  <div class="ts-main-content">
    <?php include('includes/leftbar.php'); ?>
    <div class="content">
      <?php
        //this gets the value of vehicle id from the url to show the details of the clicked vehicle 
      $vhid=intval($_GET['vhid']);
      $sql =" SELECT * from tblscooters where vid=?";
      $query = $conn -> prepare($sql);
      $query->bind_Param('i', $vhid);
      $query->execute();
      $results=$query->get_result();
      $count = $results->num_rows;
      $cnt=1;
      if($count > 0){
        while($row = $results->fetch_assoc()){  
          //displaying the images in the top of the page, if the image is empty in the database, then it will display empty string
          ?>  
          <div class="owl-carousel owl-theme">
            <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage1']);?>" class="img-fluid" alt="Image" /> </div> 

            <?php 
            if($row['Vimage2']==""){
            }else{
              ?>
              <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage2']);?>" class="img-fluid" alt="Image" /></div>
            <?php } ?>
            <?php 
            if($row['Vimage3']==""){
            }else{
              ?>
              <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage3']);?>" class="img-fluid" alt="Image" /></div>
            <?php } ?>
            <?php 
            if($row['Vimage4']==""){
            }else{
              ?>
              <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage4']);?>" class="img-fluid" alt="Image" /></div>
            <?php } ?>
            <?php 
            if($row['Vimage5']==""){
            }else{
              ?>
              <div class="item"><img src="Images/uploadedImages/<?php echo htmlentities($row['Vimage5']);?>" class="img-fluid" alt="Image" /></div>
            <?php } ?>
          </div>
          <!-- Listing details -->
          <section class="listing-detail">
            <div class="page-wrapper">
              <div class="listing_detail_head row">
                <div class="col-md-9">
                  <h2><?php echo htmlentities($row['VehiclesBrand']);?> , <?php echo htmlentities($row['VehiclesTitle']);?></h2>
                </div>
                <div class="col-md-3">
                  <div class="price_info">
                    <p>$<?php echo htmlentities($row['PricePerDay']);?> </p>Per Day
                  </div>
                </div>
              </div>
              <!-- div to show the heading of the vehicles -->
              <div class="row">
                <div class="col-md-9">
                  <div class="main_features">
                    <ul>          
                      <li><i class="fa fa-calendar" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($row['ModelYear']);?></h5>
                        <p>Reg.Year</p>
                      </li>
                      <li><i class="fa fa-cogs" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($row['FuelType']);?></h5>
                        <p>Fuel Type</p>
                      </li>
                      <?php
                      $currentVid = $row['vid'];
                      $requestSql = "SELECT * FROM transactions WHERE vehicleId = '$currentVid' AND returnStatus = 0";
                      $requestResult = $conn-> query($requestSql);
                      $resultRow = $requestResult -> num_rows;

                      if ($resultRow > 0) {
                        while($row1 = $requestResult->fetch_assoc())
                        {
                          $status = $row1['paidStatus'];

                          if($status==1){
                            $rentalStatus = "Rented Out";
                          }

                          ?>
                          <li><i class="fa fa-motorcycle" aria-hidden="true"></i>
                            <h5><?php echo htmlentities($rentalStatus);?></h5>
                            <p>Rental Status</p>
                          </li>

                        <?php }} else{?> 
                          <li><i class="fa fa-motorcycle" aria-hidden="true"></i>
                            <h5>Available for Rent</h5>
                            <p>Rental Status</p>
                          </li>
                        <?php } ?>

                      </ul>
                    </div>
                    <div class="listing_more_info">
                      <div class="listing_detail_wrap"> 
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs gray-bg" role="tablist">
                          <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
                          <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content"> 
                          <!-- vehicle-overview -->
                          <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                            <p><?php echo htmlentities($row['VehiclesOverview']);?></p>
                          </div>              
                          <!-- Accessories -->
                          <div role="tabpanel" class="tab-pane" id="accessories"> 
                            <!--Accessories-->
                            <table>
                              <thead>
                                <tr>
                                  <th colspan="2">Accessories</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>AntiLock Braking System</td>
                                  <?php if($row['AntiLockBrakingSystem']==1) { ?>
                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                  <?php } else { ?>
                                    <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                  <?php } ?>
                                </tr>   
                                <tr>
                                  <td>Leather Seats</td>
                                  <?php if($row['LeatherSeats']==1) { ?>
                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                  <?php } else { ?>
                                    <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                  <?php } ?>
                                </tr>
                                <tr>
                                  <td>Brake Assist</td>
                                  <?php if($row['BrakeAssist']==1) { ?>
                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                  <?php  } else { ?>
                                    <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                  <?php } ?>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php  $currentVid = $row['vid'];
                    $requestSql = "SELECT * FROM transactions WHERE vehicleId = '$currentVid' AND returnStatus = 0";
                    $requestResult = $conn-> query($requestSql);
                    $resultRow = $requestResult -> num_rows;
                    
                    if ($resultRow > 0) {
                      while($row1 = $requestResult->fetch_assoc())
                        {?>
                          <button class="btn btn-success" title="The scooter has been rented out" disabled>Pay with card</button>
                        <?php }

                      } else{

                        ?>
                        <!-- setting session variables for the payments -->

                        <?php $_SESSION['price'] = $row['PricePerDay']; ?>
                        <form action="stripeIPN.php?id=<?php echo $vhid; ?>" method="POST">
                          <input type="hidden" name="ownerId" value="<?=$_GET['ownerId']?>" />  
                          <input type="hidden" name="id" value="<?php echo $row['vid']?>" />  
                          <script
                          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key=<?php echo $stripeDetails['publishableKey'] ?>
                          data-amount=<?php echo $row['PricePerDay']*100?>
                          data-name=  <?php echo htmlentities($row['VehiclesTitle']);?>
                          data-email= <?php echo htmlentities($_SESSION['email']);?>
                          data-description= <?php echo htmlentities($row['VehiclesBrand']);?>
                          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                          data-locale="auto"
                          data-currency="nzd">
                        </script>
                      </form>
                    <?php }}} ?>

                  </div>
                  <!--Side-Bar-->
                  <aside class="col-md-3">
                    <div class="sidebar_widget">
                      <div class="widget_heading">
                        <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
                      </div>
                      <form method="post">
                        <div class="form-group">
                          <input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
                        </div>
                        <div class="form-group">
                          <input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
                        </div>
                        <div class="form-group">
                          <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
                        </div>
                       
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary"  name="submit" value="Book Now">
                          </div>
                      </form>
                    </div>
                  </aside>
                  <!--/Side-Bar--> 
                </div>
              </div>
              <!-- RATING SECTION -->
                                  <div align="center" style="padding: 50px;color:#000;">
                      <i class="fa fa-star fa-2x" data-index="0"></i>
                      <i class="fa fa-star fa-2x" data-index="1"></i>
                      <i class="fa fa-star fa-2x" data-index="2"></i>
                      <i class="fa fa-star fa-2x" data-index="3"></i>
                      <i class="fa fa-star fa-2x" data-index="4"></i>
                      <br><br>
                      <?php echo round($avg,2) ?>
                  </div>
              <!-- COMMENT SECTION -->
              <br><h1 style="margin-left: 20px;">Add Comment</h1>
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <!-- ADD COMMENT -->
                    <textarea class="form-control" id="mainComment" placeholder="Add Comment" cols="30" rows="2"></textarea><br>
                    <!-- <?php $vid = $_GET['vhid']; 
                        echo "VID", $vid;
                    ?> -->
                    <button style="float: right;" class="btn-primary btn" onclick="isReply = false;" id="addComment">Add Comment</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <!-- DISPLAY the number of comments -->
                    <h2><b id="numComments"><?php echo $numComments ?> Comments</b></h2>
                    <div class="userComments">

                    </div>
                  </div>
                </div>
              </div>
              <!-- REPLY -->
              <div class="replyRow" style="display: none">
                <div class="col-md-12">
                  <textarea class="form-control" id="replyComment" placeholder="Add Comment" cols="30" rows="2"></textarea><br>
                  <button style="float: right;" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
                  <button style="float: right;" class="btn-default" onclick="$('.replyRow').hide();">Close</button>
                </div>
              </div>

            </section>
          </div>
        </div>
        <!-- Loading Scripts -->
       
       
        <script src="js/owl.carousel.min.js"></script>
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
        <script src="js/scooterDetail.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        
        <script type="text/javascript">
          var isReply = false, vehicleID = <?php echo $_GET['vhid'] ?>, commentID = 0, max = <?php echo $numComments ?>, ratedIndex = -1, uID = 0;;
          $(document).ready(function(){
            $("#addComment, #addReply").on('click', function(){
              var comment;
                //onclick for add reply button is set to true when clicked
                if(!isReply)
                  comment = $("#mainComment").val();
                else
                  comment = $("#replyComment").val();

                if(comment.length > 5){
                  $.ajax({
                    url: 'scooterDetail.php',
                    method: 'POST',
                    dateType: 'text',
                    data: {
                      addComment: 1,
                      comment: comment,
                      isReply: isReply,
                      commentID: commentID,
                      vehicleID: vehicleID
                    }, success: function (response){
                      max++;
                      $("#numComments").text(max + " Comments");

                      if(!isReply){
                        $(".userComments").prepend(response);
                        //empty mainComment
                        $("mainComment").val("");
                      }else{
                        //reser commentID back to 0
                        commentID = 0;
                        $("#replyComment").val("");
                        $(".replyRow").hide();
                        //Find reply parent then next = div(replies) and append reply
                        $('.replyRow').parent().next().append(response);
                      }
                    }
                  });
                }else
                alert('Please enter a comment');
              });
              //call FUNCTION getALLComments: to get the comments.
              //Start at 0 and pass in the maximum as well from the beginning php script, $numComments
              getAllComments(0, max);


            //RATING - document ready
            resetStarColors();
              if (localStorage.getItem('ratedIndex') != null) {
                  setStars(parseInt(localStorage.getItem('ratedIndex')));
                  uID = localStorage.getItem('uID');
              }

              $('.fa-star').on('click', function () {
                 ratedIndex = parseInt($(this).data('index'));
                 localStorage.setItem('ratedIndex', ratedIndex);
                 saveToTheDB();
              });

              $('.fa-star').mouseover(function () {
                  resetStarColors();
                  var currentIndex = parseInt($(this).data('index'));
                  setStars(currentIndex);
              });

              $('.fa-star').mouseleave(function () {
                  resetStarColors();

                  if (ratedIndex != -1)
                      setStars(ratedIndex);
              });
            });
            //FUNCTION for REPLY fields to appear after reply button is clicked
            function reply(caller){
              commentID = $(caller).attr('data-commentID');
              $(".replyRow").insertAfter($(caller));
              $('.replyRow').show();
            }
            //FUNCTION to dynamically get all the comments from DB: start and maximum number of comments
            function getAllComments(start, max){
              //IF start is bigger than max we will exit and stop getting the comments
              if(start > max){
                return;
              }
              $.ajax({
                url: 'scooterDetail.php',
                method: 'POST',
                dateType: 'text',
                data: {
                      //flag
                      getAllComments: 1,
                      //start
                      start: start
                    }, success: function (response){
                      //grab the UserComments and append
                      $(".userComments").append(response);
                      //increase starting point by 20 for the number of comments returned during each iteration              
                      getAllComments((start+20), max);
                    }
                  });
            }

        //RATING - functions
        function saveToTheDB() {
            $.ajax({
               url: "scooterDetail.php",
               method: "POST",
               dataType: 'json',
               data: {
                   save: 1,
                   uID: uID,
                   ratedIndex: ratedIndex
               }, success: function (r) {
                    uID = r.id;
                    localStorage.setItem('uID', uID);
               }
            });
        }

        function setStars(max) {
            for (var i=0; i <= max; i++)
                $('.fa-star:eq('+i+')').css('color', 'yellow');
        }

        function resetStarColors() {
            $('.fa-star').css('color', 'black');
        }
  </script>
</body>
</html>