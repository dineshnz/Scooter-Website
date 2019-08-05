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

function updateData()
{
    //retrieve all the data sent from the form in myProfile.php and store them into different variables
    var id=document.getElementById("id").value;
    var full_name=document.getElementById("full_name").value;
    var email_address=document.getElementById("email_address").value;
    var address=document.getElementById("address").value;
    var passport_number=document.getElementById("passport_number").value;
    var driver_license=document.getElementById("driver_license").value;

    //setting up what method and where the data should pass to next
    var requestBody="id="+encodeURIComponent(id)+"&fullname="+encodeURIComponent(full_name)+"&email="+encodeURIComponent(email_address)+"&address="+encodeURIComponent(address)+"&passport="+encodeURIComponent(passport_number)+"&driverLicense="+encodeURIComponent(driver_license);
    xhr.open("POST","myprofile_updateProcess.php",true);
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

function updatePassword()
{
    var id=document.getElementById("id").value;
    var currentPassword=document.getElementById("currentPassword").value;
    var newPassword=document.getElementById("newPassword").value;
    var confirmPassword=document.getElementById("confirmPassword").value;

    var requestBody="id="+encodeURIComponent(id)+"&currentPassword="+encodeURIComponent(currentPassword)+"&newPassword="+encodeURIComponent(newPassword)+"&confirmPassword="+encodeURIComponent(confirmPassword);
    xhr.open("POST","mypassword_updateProcess.php",true);
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