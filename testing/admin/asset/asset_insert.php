<meta charset="utf-8">

<?php
include('../conn.php');
$count = mysql_query('insert into asset(assetName,plateNumber,make,model,status,colour,img,price,attachments,address,timestamp) 
values("'.$_POST['assetName'].'",
"'.$_POST['plateNumber'].'",
"'.$_POST['make'].'",
"'.$_POST['model'].'",
"'.$_POST['status'].'",
"'.$_POST['colour'].'",
"'.$_POST['img'].'",
"'.$_POST['price'].'",
"'.$_POST['attachments'].'",
"'.$_POST['address'].'",
"'.$_POST['timestamp'].'")');




	echo '<a href="../main.html">返回主页</a>';

?>
