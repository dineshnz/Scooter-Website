
<?php
include('../conn.php');
$count=mysql_query('update asset set 

assetName = "'.$_POST['assetName'].'", 
plateNumber = "'.$_POST['plateNumber'].'", 
make = "'.$_POST['make'].'", 
model = "'.$_POST['model'].'", 
status = "'.$_POST['status'].'", 
colour = "'.$_POST['colour'].'", 
img = "'.$_POST['img'].'", 
attachments = "'.$_POST['attachments'].'", 
address = "'.$_POST['address'].'", 
timestamp = "'.$_POST['timestamp'].'"
where assetID = '.$_POST['assetID']);


if($row>0){

	echo '<a href="../main.html">index</a>';
}
else{      

	echo '<a href="../main.html">index</a>';
}
?>