

<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	include('../conn.php');
?>
<?php
	$result = mysql_query("select * from asset");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Asset_List</title>
 <style type="text/css">
 table.gridtable {
     font-family: verdana,arial,sans-serif;
    font-size:11px;
    color:#333333;
    border-width: 1px;
    border-color: #666666;
    border-collapse: collapse;
 }
table.gridtable th {
     border-width: 1px;
     padding: 8px;
     border-style: solid;
    border-color: #666666;
    background-color: #dedede;
 }
 table.gridtable td {
     border-width: 1px;
     padding: 8px;
     border-style: solid;
     border-color: #666666;
     background-color: #ffffff;
}
 </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/adminStyle.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/public.js"></script>
</head>
<body>
 <div class="wrap">



 <?php	
echo '<table class="gridtable">';
echo ' <caption><h2> Asset_List</h2></caption>';
echo '<tr><th>AssetID</th>
		<th>OwnerID</th>
		<th>AssetName</th>
		<th>AssertImg</th>
		<th>PlateNumber</th>
		<th>Make</th>
		<th>Model</th>
		<th>Status</th>
		<th>Colour</th>
		<th>Price</th>
		<th>Arrachments</th>
		<th>Address</th>
		<th>Timestamp</th>
		<th>Operation</th>

';
while($row = mysql_fetch_array($result)){
	echo '<tr>';
	echo '<td>'.$row['assetID'].'</td>';
	echo '<td>'.$row['ownerID'].'</td>';
	echo '<td>'.$row['assetName'].'</td>';
	echo '<td style="width:20%"><img src ="../../images/'.$row['img'].'" style="width:50%"></td>';
	echo '<td>'.$row['plateNumber'].'</td>';
	echo '<td>'.$row['make'].'</td>';
	echo '<td>'.$row['model'].'</td>';
	echo '<td>'.$row['status'].'</td>';
	if($row['colour'] == 1){
		echo '<td>red</td>';
	}
	if($row['colour'] == 2){
		echo '<td>blue</td>';
	}
	
	echo '<td>$'.$row['price'].'</td>';
	echo '<td>'.$row['attachments'].'</td>';
	echo '<td>'.$row['address'].'</td>';
	echo '<td>'.$row['timestamp'].'</td>';
	
?>

	<td class="center">
		<a href="asset_update.php?assetID=<?=$row['assetID'] ?>">Edit</a>
		<a href="asset_delete.php?assetID=<?=$row['assetID'] ?>" onclick="return confirm('Are you sure？');">Delete</a>
	</td>
	</tr>
<?php
}
echo '</table>';


?>













 </div>
</body>
</html>