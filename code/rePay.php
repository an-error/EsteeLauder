<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/6
 * Time: 23:56
 */

include("conn.php");
$orderID=$_POST['orderID'];
$repay=$_POST['pay'];
$sql="update esteeLauder.order set status='待发货',isPay='".$repay."' where id='".$orderID."'";
$db->query($sql);