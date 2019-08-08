// file xhr.js
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


	var refCheck = /^[0-9a-zA-z]{0,30}$/;

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

function addScooterToDatabase(){
	if(xhr){
		event.preventDefault();
		var obj = document.getElementById("success");
		var vehicletitle = $('#vehicletitle').val();
		var vehiclebrand = $('#vehiclebrand').val();
		var vehicalorcview = $('#vehicleoverview').val();
		var priceperday = $('#priceperday').val();
		var fueltype = $('#fueltype').val();
		var modelyear = $('#modelyear').val();
		var img1 =  document.getElementById('user_image1').value;
		var img2= document.getElementById('user_image2').value;
		var img3 =document.getElementById('user_image3').value;
		var img4 = document.getElementById('user_image4').value;
		var img5 = document.getElementById('user_image5').value;
		var antilockbrakingsys = $('#antilockbrakingsys').val();
		var brakeassist = $('#brakeassist').val();
		var leatherseats = $('#leatherseats').val();

		var requestbody ="vehicletitle="+encodeURIComponent(vehicletitle)+
		"&vehiclebrand="+encodeURIComponent(vehiclebrand)+
		"&vehicalorcview="+encodeURIComponent(vehicalorcview)+
		"&priceperday="+encodeURIComponent(priceperday)+
		"&fueltype="+encodeURIComponent(fueltype)+
		"&modelyear="+encodeURIComponent(modelyear)+
		"&img1="+encodeURIComponent(img1)+
		"&img2="+encodeURIComponent(img2)+
		"&img3="+encodeURIComponent(img3)+
		"&img4="+encodeURIComponent(img4)+
		"&img5="+encodeURIComponent(img5)+
		"&antilockbrakingsys="+encodeURIComponent(antilockbrakingsys)+
		"&brakeassist="+encodeURIComponent(brakeassist)+
		"&leatherseats="+encodeURIComponent(leatherseats);
			var url = "insertVehicle.php";
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					obj.innerHTML = xhr.responseText;
					$(document).ready(function(){
					$("#userModal").modal("show");
			
					});
			
				}
			}
			xhr.send(requestbody);

	}


}

function sendRequestForApproval(vhid){
	if(xhr){
		event.preventDefault();
		var obj = document.getElementById("success");
		console.log(vhid);
		var requestbody ="vhid="+encodeURIComponent(vhid);
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

