<?php 
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
?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>My assets</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/style.css">

  <style>

   .box
   {
    width:95%;
    padding:10px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:10px;
  }

  #records_content{
   width: 90%;
   margin-left:30px;
 }
</style>
</head>
<body>
 <?php include('includes/profileHeader.php');?>
 <div class="ts-main-content">
   <?php include('includes/leftbar.php');?>
   <div class="content-wrapper" style="margin-top: 80px!important">

    <div id="records_content">	</div>

  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>

<div class="modal fade" id="update_scooter_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="form-group">
          <label> Vehicle Title </label>
          <input type="text" name="title" id="update_title" placeholder="Title" class="form-control">
        </div>

        <div class="form-group">
          <label>Vehicle Overview </label>
          <input type="text" name="overview" id="update_overview" placeholder="Vehicle overview" class="form-control">
        </div>

        <div class="form-group">
          <label> Price Per Day </label>
          <input type="text" name="price" id="update_price" placeholder="price per day" class="form-control">
        </div>



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Update</button>
       <input type="hidden" id="hidden_scooter_id">
     </div>



   </div>
 </div>
</div>



<script type="text/javascript" language="javascript" src="js/showScooters.js" ></script>


<script type="text/javascript" language="javascript" >
  $(document).ready(function () {
    readRecords(); 
  });


 //display the result
 //////////////////Display Records
 function readRecords(){

  var readrecords = "readrecords"; 
  $.ajax({
   url:"controllers/myListingController.php",
   type:"POST",
   data:{readrecords:readrecords},
   success:function(data,status){
    $('#records_content').html(data);
  },

});
}

function GetUserDetails(id){
 $("#hidden_scooter_id").val(id);
 $.post("controllers/myListingController.php", {
  id: id
},
function (data, status) {
            // alert(data);
            //JSON.parse() parses a string, written in JSON format, and returns a JavaScript object.
            var scooter = JSON.parse(data);
            //alert(scooter);

            $("#update_title").val(scooter.VehiclesTitle);
            $("#update_overview").val(scooter.VehiclesOverview);
            $("#update_price").val(scooter.PricePerDay);

          }
          );
 $("#update_scooter_modal").modal("show");
}




function UpdateUserDetails() {
  var title = $("#update_title").val();
  var overview = $("#update_overview").val();
  var price = $("#update_price").val();
  var hidden_scooter_id = $("#hidden_scooter_id").val();
  $.post("controllers/myListingController.php", {
    hidden_scooter_id: hidden_scooter_id,
    title: title,
    overview: overview,
    price: price,

  },
  function (data, status) {
    $("#update_scooter_modal").modal("hide");
    readRecords();
  }
  );
}

 /////////////delete userdetails ////////////
 function DeleteUser(deleteid){

  var conf = confirm("Are you sure, you want to delete this listing?");
  if(conf == true) {
    $.ajax({
      url:"controllers/myListingController.php",
      type:'POST',
      data: {  deleteid : deleteid},

      success:function(data, status){
        readRecords();
      }
    });
  }
}



</script>
