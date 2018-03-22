<?php
		/*$conn=mysql_connect("localhost","root","lll777");
	
    $db_selected=mysql_select_db("esteelauder",$conn);
	if(!$db_selected || !$conn){
		die("Can't use esteelauder:".mysql_error());
	}
    mysql_query("set names 'utf-8'");*/


    try{
        $db=new PDO('mysql:host=localhost;dbname=esteelauder','root',"lll777",
        array(PDO::ATTR_PERSISTENT=>true));
    }catch(PDOException $e){
        print "Error:".$e->getMessage()."<br/>";
        die();
    }


	

