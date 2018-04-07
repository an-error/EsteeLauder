<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/4
 * Time: 9:27
 */

include("conn.php");
session_start();
$del=$_POST['del'];



if($del!=""){
    $del=explode(",",$_POST['del']);
    foreach ($del as $value){
       /* $sql="delete from address where id='".$value."'";
        $collection['sql']=$sql;*/
        $statement=$db->prepare("SET FOREIGN_KEY_CHECKS = 0; delete from address where id=:id");
        $statement->bindParam(":id",$value,PDO::PARAM_STR);
        $statement->execute();
    }

}

$_SESSION['addressID']=$_POST['checked'];

$collection['post']=$_POST;
echo json_encode($collection);