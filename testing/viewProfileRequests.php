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
  <title>View Pending Requests</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/style.css">

  <style>
    .content{
      margin-top: 80px;
      margin-left: 250px;
    }  

    #targetDiv{
      margin-top: 30px;
      width: 95%;
      margin-left:30px;
    }

  </style>

  
</head>
<body>
 <?php include('includes/profileHeader.php');?>
 <div class="ts-main-content">
  <?php include('includes/leftbar.php');?>

  <div class="content">

    <div id="targetDiv">	</div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>

<!--Start of modal to show results-->
<div class="modal fade" id="responseModal" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Response</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body" id="success">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript" src="js/showScooters.js"></script>
<script type="text/javascript" language="javascript" >
  $(document).ready(function () {
   viewPendingRequests(); 
 });

  function createRequest() {
    var xhr = false;  
    if (window.XMLHttpRequest) {
      xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhr;
} // end function createRequest()

var xhr= createRequest();
    //This function will accept the request to view profile
    function onAcceptRequest(requestFromId){
      if(xhr){
        var obj = document.getElementById("success");
        var requestbody ="requestFromId="+encodeURIComponent(requestFromId);
        var url = "profileRequest/acceptProfileRequest.php";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
         if(xhr.readyState == 4 && xhr.status == 200){
          obj.innerHTML = xhr.responseText;
          $(document).ready(function(){
            $("#responseModal").modal("show");

          });
          viewPendingRequests();
        }
      }
      xhr.send(requestbody);
    }
  }

//  function to view pending profile requests
  function viewPendingRequests(){
    if(xhr){
      var obj = document.getElementById("targetDiv");
      var dataSource = "profileRequest/viewPendingRequestProcess.php";
      xhr.open("POST", dataSource, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function(){
       if(xhr.readyState == 4 && xhr.status == 200){
        obj.innerHTML = xhr.responseText;
      }
    }
    xhr.send();
  }
}

//function to reject the request of the profile 
function onRejectRequest(requestFromId){
  if(xhr){
    var obj = document.getElementById("success");
    var requestbody ="requestFromId="+encodeURIComponent(requestFromId);
    var url = "profileRequest/rejectProfileRequest.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
     if(xhr.readyState == 4 && xhr.status == 200){
      obj.innerHTML = xhr.responseText;
      $(document).ready(function(){
        $("#responseModal").modal("show");

      });
      viewPendingRequests();
    }
  }
  xhr.send(requestbody);
}
}


</script>
