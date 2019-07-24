
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style>
body
{
  background-image: url("background.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  font-family: Arial, Helvetica, sans-serif;
} 

input[type=text]
{
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

input[type=email] 
{
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  margin-left: 37px;
}

input[type=submit]
{
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover
{
  background-color: #45a049;
}

textarea
{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  height: 200px;
}

form
{
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 100px;
  height: 800px;
  width: 800px;
  margin: auto;
}

h1
{
  text-align: center;
}
</style>

</head>
<body>
<br><br><br>
<h1>Contact Us Form</h1>
<?php include 'header.php' ?>
	
<div class="form">  
  <form action="hello.php" method="post">
    <label>First Name: <input type="text" name="fname" required="required" placeholder="First Name"></label>
    <br>
    <label>Last Name: <input type="text" name="lname" required="required" placeholder="Last Name"></label>
    <br>
    <label>Email: <input type="email" name="email" required="required" placeholder="Email"></label>
    <br>
    <label>Subject: <input type="text" name="subject" required="required" placeholder="Subject"></label>
    <br>
    <label>Message: </label>
    <textarea name="message" id="message" placeholder="Message"></textarea>
    
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
  </form>

</div>

</body>
</html>