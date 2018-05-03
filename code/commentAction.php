<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/9
 * Time: 17:07
 */

include("conn.php");

if($_POST['action']=="update"){
    $sql="update comment set isShow=1 where id='".$_POST['commentID']."'";

}

if($_POST['action']=='delete'){
    //$sql="delete from comment where id='".$_POST['commentID']."'";
    $sql="update comment set isDelete=1 where id='".$_POST['commentID']."'";

}

$statement=$db->prepare($sql);
$statement->execute();
echo $sql;