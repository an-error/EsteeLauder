<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/5
 * Time: 18:37
 */
include("conn.php");
if($_POST['option']=='待发货'){
    $sql="update esteeLauder.order set status='待发货',isPay='true'"." where id='".$_POST['orderID']."'";
    $db->query($sql);
}
$sql="update esteelauder.order set status='".$_POST['option']."' where id='".$_POST['orderID']."'";
$statement=$db->query($sql);

