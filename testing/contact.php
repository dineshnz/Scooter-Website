
<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script type="text/javascript" src="js/contactUs.js"></script>
<style>
body
{
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  font-family: Arial, Helvetica, sans-serif;
} 

input[type=text]
{
  width: 40%;
  padding: 12px;
  border: 1px solid #84bae0;
  border-radius: 5px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

input[type=email] 
{
  width: 40%;
  padding: 12px;
  border: 1px solid #84bae0;
  border-radius: 5px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  margin-left: 37px;
}

input[type=button]
{
  background-color: #007EA7;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=button]:hover
{
  background-color: #84bae0;
}

textarea
{
  width: 100%;
  padding: 12px;
  border: 1px solid #84bae0;
  border-radius: 5px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  height: 150px;
}

form
{
  border-color: #84bae0;
  border-radius: 5px;
  background-color: #FFFFFF;
  padding: 80px;
  height: 950px;
  width: 800px;
  margin: auto;
}

h1
{
  text-align: center;
  color: #007EA7;
}
</style>

</head>
<body>
<br><br><br>
<?php include 'header.php' ?>
	  
  <form action="contactProcess.php" method="post">
  <h1>Contact Us</h1>
    <label>Username: </label><br>
    <input type="text" id="uname" name="uname" required="required" placeholder="Username">
    <br>
    <label>Email: </label><br>
    <input type="text" id="email" name="email" required="required" placeholder="Email">
    <br>
    <label>Subject: </label><br>
    <input type="text" id="subject" name="subject" required="required" placeholder="Subject">
    <br>
    <label>Driver License: </label><br>
    <input type="text" id="driverLicense" name="subject" required="required" placeholder="Subject">
    <br>
    <label>Passport: </label><br>
    <input type="text" id="passport" name="subject" required="required" placeholder="Subject">
    <br>
    <label>Message: </label>
    <textarea name="message" id="message" placeholder="Message"></textarea>
    
    <input type="button" value="Submit" onclick="sendContact()">
    <input type="reset" value="Reset">
    <p id="response"></p>
  </form>

</body>
</html>