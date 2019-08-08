
<meta charset="utf-8">
<h1>Asset_Update</h1>
<?php
include('../conn.php');
?>
<?php
$result = mysql_query('select * from asset where assetID = '.$_GET['assetID'].' limit 1');
$asset = mysql_fetch_assoc($result);
?>
<link href="../style/adminStyle.css" rel="stylesheet" type="text/css" />


<form action="asset_updatend.php" method="post">
	<table class="list-style">
	<input type="hidden" name="assetID" value="<?=$asset['assetID'] ?>">
		<tr>
		<td style="width:15%;text-align:right;">assetName：</td>
		<td><input type="text"  class="textBox length-middle" name="assetName" value="<?=$asset['assetName'] ?>"></td>
		</tr>
		
		<tr>	
		<td style="width:15%;text-align:right;">plateNumber：</td>
		<td><input type="number" class="textBox length-middle" name="plateNumber" value="<?=$asset['plateNumber'] ?>"></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">make：</td>
		<td><input type="text" class="textBox length-middle"  name="make" value="<?=$asset['make'] ?>"></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">model：</td>
		<td><input type="text" class="textBox length-middle"  name="model" value="<?=$asset['model'] ?>"></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">status：</td>
		
				<td><select name="status" class="textBox length-middle" >
				<?php
					if($asset['status'] == 1){
						?>
						<option value="1" selected =true>Free</option>
						<option value="2">Rented</option>
				<?php
					}
					if($asset['status'] == 2){
						?>
						<option value="1">Free</option>
						<option value="2" selected = true >Rented</option>
				<?php		
					}
				?>
					
				</select>
				  </td>
		
		</tr>
		<tr>
		<td style="width:15%;text-align:right;">colour：</td>
			<td>	
	
			<?php
					if($asset['colour'] == 1){
						?>
						<input type="radio" name="colour" value="1" checked>red
						<input type="radio" name="colour" value="2">blue
				<?php
					}else{
					
					?>
						<input type="radio" name="colour" value="1">red
						<input type="radio" name="colour" value="2" checked>blue
				<?php		
					}
				?>
			</td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">img：</td>
		<td><input type="file" class="textBox length-middle"  name="img" value="<?=$asset['img'] ?>"></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">price：</td>
		<td><input type="number" class="textBox length-middle"  name="price" value="<?=$asset['price'] ?>">  </td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">attachments：</td>
		<td><input type="text" class="textBox length-middle"  name="attachments" value="<?=$asset['attachments'] ?>"></td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">address：</td>
		<td><input type="text" class="textBox length-middle" name="address" value="<?=$asset['address'] ?>">  </td>
		</tr>
		
		<tr>
		<td style="width:15%;text-align:right;">timestamp：</td>
		<td><input type="date" class="textBox length-middle" name="timestamp" value="<?=$asset['timestamp'] ?>">  </td>
		</tr>
		
		<tr>
			<td style="text-align:right;"></td>
			<td><input type="submit" class="tdBtn" value="Update_Asset"/></td>
	    </tr>
		
	</table>
</form>

