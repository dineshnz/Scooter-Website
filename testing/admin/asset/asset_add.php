<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>后台管理系统</title>

<link href="../style/adminStyle.css" rel="stylesheet" type="text/css" />
</head>
<style>
</style>
<body>
<h1>Asset_Add</h1>
<?php
	include('../conn.php');
?>
<form action="asset_insert.php" method="post">
	<table class="list-style">

		<tr>
		<td style="width:15%;text-align:right;">assetName：</td>
		<td><input type="text"  class="textBox length-middle" id="payCount_Max" name="assetName"></td>
		</tr>
		
		<tr>	
		<td style="width:15%;text-align:right;">plateNumber：</td>
		<td><input type="number" οnclick="noFuc(this.value)" class="textBox length-middle"  name="plateNumber" ></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">make：</td>
		<td><input type="text" class="textBox length-middle"  name="make"></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">model：</td>
		<td><input type="text" class="textBox length-middle"  name="model"></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">status：</td>
		
			<td>	<select name="status" class="textBox length-middle" >
					<option value="1">Free</option>
					<option value="2">Rented</option>
				</select>
				  </td>
		
		</tr>
		<tr>
		<td style="width:15%;text-align:right;">colour：</td>
				<td><input type="radio" name="colour" value="1">red
					<input type="radio" name="colour" value="2">blue</td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">img：</td>
		<td><input type="file" class="textBox length-middle"  name="img">  </td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">price：</td>
		<td><input type="number" class="textBox length-middle"  name="price">  </td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">attachments：</td>
		<td><input type="text" class="textBox length-middle"  name="attachments">  </td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">address：</td>
		<td><input type="text" class="textBox length-middle" name="address">  </td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">timestamp：</td>
		<td><input type="date" class="textBox length-middle" name="timestamp">  </td>
		</tr>
		
		<tr>
			<td style="text-align:right;"></td>
			<td><input type="submit" class="tdBtn" value="Asset_Add"/></td>
	    </tr>
		
	</table>
</form>
</body>
</html>