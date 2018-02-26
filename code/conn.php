<?php
	$conn=mysql_connect("localhost","root","lll777");
	mysql_query("set names 'utf8'");
    $db_selected=mysql_select_db("esteelauder",$conn);
	if(!$db_selected || !$conn){
		die("Can't use esteelauder:".mysql_error());
	}
    mysql_query("set names 'utf-8'");  
?>