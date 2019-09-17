function createRequest() 
{
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

function sendContact()
{
    var username=document.getElementById("uname").value;
    var email=document.getElementById("email").value;
    var subject=document.getElementById("subject").value;
    var driverLicense=document.getElementById("driverLicense").value;
    var passport=document.getElementById("passport").value;
    var message=document.getElementById("message").value;

    var requestBody="username="+encodeURIComponent(username)+"&email="+encodeURIComponent(email)+"&subject="+encodeURIComponent(subject)+"&driverLicense="+encodeURIComponent(driverLicense)+"&passport="+encodeURIComponent(passport)+"&message="+encodeURIComponent(message);
    xhr.open("POST","contactProcess.php",true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.onreadystatechange=function()
    {
        if(xhr.readyState==4 && xhr.status==200)
        {
            var response=document.getElementById("response");
            response.innerHTML = xhr.responseText;
        }
    }   
    xhr.send(requestBody);
}
