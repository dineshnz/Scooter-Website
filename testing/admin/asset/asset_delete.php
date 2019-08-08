
<meta charset="utf-8">
<?php
include('../conn.php');
$row = mysql_query('delete from asset where assetID = '.$_GET['assetID'].'');
if($row>0){
	echo '<h1>OK</h1>';
	echo '<a href="../main.html">返回主页</a>';
}
else{      
	echo '<h1>ERROR</h1>';
	echo '<a href="../main.html">返回主页</a>';
}
?>