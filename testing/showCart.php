<?php
header("content-type:text/html;charset=utf-8");
include("admin/conn.php");
session_start();
$GET_assetName = $_GET['assetName'];
$GET_assetID   = $_GET['assetID'];
$GET_price     = $_GET['price'];
$GET_img       = $_GET['img'];
$GET_make      = $_GET['make'];
$GET_timestamp = $_GET['timestamp'];


$cart = mysql_query('select * from cart where assetID ='.$GET_assetID.'');
$row = mysql_fetch_array($cart);
	if(!$row){
		$sql = mysql_query('insert into cart(assetID,assetName,make,timestamp,price,img) values("'.$GET_assetID.'","'.$GET_assetName.'","'.$GET_make.'","'.$GET_timestamp.'","'.$GET_price.'","'.$GET_img.'")');
		header("location:cart.php");
		
	}else{
		header("location:list.php");
	}

?>