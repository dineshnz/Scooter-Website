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

	console.log(searchInput);
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