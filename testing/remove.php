<?php
include("admin/conn.php");
$row = mysql_query('delete from cart where cid = '.$_GET['cid'].'');

	header("location:cart.php");
?>