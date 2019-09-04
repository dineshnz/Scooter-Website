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


function searchScooter(){
	if(xhr){
        var obj = document.getElementById("targetDiv");
        var searchInput = document.getElementById("searchInput").value;
        var dataSource = "showScooterProcess.php";
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

function validation(){
	var searchInput = document.getElementById("searchInput").value;


	var refCheck = /^[0-9a-zA-z ]{0,30}$/;

	if(searchInput==""){
        document.getElementById('refErr').innerHTML = "Passport input is required";
        return false;
      }
      else if(!refCheck.test(searchInput)){
        document.getElementById('refErr').innerHTML = "Only letters and numbers are allowed";
        return false;
      }
      else{
        document.getElementById('refErr').innerHTML = "";
      }

    searchScooter();

}

//this function accepts the request for viewing vehichles
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

//This function shows the pending requests to view the vehicles
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

//This function rejects the request to view vehicles
function onRejectRequest(vehicleId, userId){
  if(xhr){
    var obj = document.getElementById("success");
    var requestbody ="vehicleId="+encodeURIComponent(vehicleId)+
    "&userId="+encodeURIComponent(userId);
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


//This function is for sending requests to owner of the vehicle to get the permission to view the vehicle.
function sendRequestForApproval(vhid, ownerId, vehicleTitle, vehicleBrand){
	if(xhr){
		event.preventDefault();
		var obj = document.getElementById("success");
		var requestbody ="vhid="+encodeURIComponent(vhid)+
		"&ownerId="+encodeURIComponent(ownerId)+
		"&vehicleBrand="+encodeURIComponent(vehicleBrand)+
		"&vehicleTitle="+encodeURIComponent(vehicleTitle);
			var url = "sendRequest.php";
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

//function to send request from owner to user to view their profile
function sendRequestForProfile(historyId, userId){
	if(xhr){
		event.preventDefault();
		var obj = document.getElementById("success");
		var requestbody ="historyId="+encodeURIComponent(historyId)+
		"&userId="+encodeURIComponent(userId);
			var url = "sendRequestForProfile.php";
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

//THis function is to view the history of the renters
function viewUserHistory(historyId){
	if(xhr){
		var obj = document.getElementById("success");
		var requestbody ="historyId="+encodeURIComponent(historyId);
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





