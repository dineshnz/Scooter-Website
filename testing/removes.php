<?php
include("admin/conn.php");
$row = mysql_query('delete from cart where cid in ('.$_POST['ids'].')');
?>