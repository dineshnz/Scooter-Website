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
          
          margin-top: 0px;
          margin-left: 250px;
          
           }  

      .main {
          width: 40%;
          margin: 10px auto;
      }


        #targetDiv{
            margin-top: 30px;
            width: 95%;
            margin-left:30px;
        }

        #referenceTarget{
          margin:0 auto;
          width: 40%;
          text-align: center;
          
        }

        .firstLine{
          border-left: 6px solid red;
          background-color: #9ba832;
          box-sizing: content-box;
          width: 50%;
          margin: 10px auto;

        }
        
        
        </style>
        
  
 </head>
 <body>
 <?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
  <?php include('includes/leftbar.php');?>

		<div class="content">
        <div class="row" style="background:lightgray; margin-top:19px; padding-top:10px">
          <div class="col-md-6 firstCol">
          <h3 class=" text-center text-white firstLine">Search Renter's history</h3>
        <p class="text-center">Please enter the name or passport number<br> you know about the requester<br> to search his/her renting history</p>

        <form>
          <div class="main">
          <div class="input-group">
	
            <input type="text" class="form-control" id="searchInput" placeholder="dinesh Karki" required>
            
            <div class="input-group-append">
                <button class="btn btn-secondary" id="searchBtn" type="button" onclick="validation()">
                  <i class="fa fa-search"></i>
                </button>
            </div>
              
            </div>
            <span id="refErr" class="text-danger font-weight-bold"></span>
          </div>
	    	</form>
        

          </div>
          <div id="referenceTarget" class="col-md-4" ></div>
          
        </div>
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

//function to view the reuslt of renter's profile
function searchHistory(){
	if(xhr){
        var obj = document.getElementById("referenceTarget");
        var searchInput = document.getElementById("searchInput").value;
        var dataSource = "showProfileRequestResult.php";
        var requestbody ="searchInput="+encodeURIComponent(searchInput);
		xhr.open("POST", dataSource, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4 && xhr.status == 200){
				obj.innerHTML = xhr.responseText;
			}
		}
		xhr.send(requestbody);
	}
}

//this function will validate the input from the user when searching the history
function validation(){
	var searchInput = document.getElementById("searchInput").value;


	var refCheck = /^[0-9a-zA-z ]{0,30}$/;

	if(searchInput==""){
        document.getElementById('refErr').innerHTML = "fullname or passport number input is required";
        return false;
      }
      else if(!refCheck.test(searchInput)){
        document.getElementById('refErr').innerHTML = "Only letters numbers and spaces are allowed";
        return false;
      }
      else{
        document.getElementById('refErr').innerHTML = "";
      }

   searchHistory();

}



var xhr= createRequest();

  function onAcceptRequest(vehicleId, requesterId){
  if(xhr){
    var obj = document.getElementById("success");
    var requestbody ="vehicleId="+encodeURIComponent(vehicleId)+
    "&requesterId="+encodeURIComponent(requesterId);
		var url = "accept.php";
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

function viewPendingRequests(){
  if(xhr){
		var obj = document.getElementById("targetDiv");
		var dataSource = "viewPendingRequest.php";
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

function onRejectRequest(vehicleId, requesterId){
  if(xhr){
    var obj = document.getElementById("success");
    var requestbody ="vehicleId="+encodeURIComponent(vehicleId)+
    "&requesterId="+encodeURIComponent(requesterId);
		var url = "reject.php";
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



//function to send request from owner to user to view their profile
function sendRequestForProfile(userId){
	if(xhr){
		event.preventDefault();
		var obj = document.getElementById("success");
		var requestbody ="userId="+encodeURIComponent(userId);
			var url = "sendRequestForProfile.php";
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					obj.innerHTML = xhr.responseText;
					$(document).ready(function(){
			  $("#responseModal").modal("show");
	  
			    });
          searchHistory(); 
				}
				
			}
			xhr.send(requestbody);
		}
}

// 
//THis function is to view the history of the renters
function viewUserHistory(userId){
	if(xhr){
		var obj = document.getElementById("success");
		var requestbody ="userId="+encodeURIComponent(userId);
			var url = "userHistory.php";
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					obj.innerHTML = xhr.responseText;
					$(document).ready(function(){
			  $("#responseModal").modal("show");
	  
			});
		
				}
			}
			xhr.send(requestbody);
		}
}

  
  </script>
