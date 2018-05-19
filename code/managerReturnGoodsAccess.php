<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/14
 * Time: 8:53
 */

include("conn.php");

if($_POST['access']=="驳回申请"){
    $sql="update returnGoods set status='驳回申请' where id='".$_POST['returnID']."'";
    $access="驳回申请";

}else if($_POST['access']=="允许退货"){
    $sql="update returnGoods set status='允许退货' where id='".$_POST['returnID']."'";
    $access="允许退货";
}else if($_POST['access']=="退回"){
    $sql="update returnGoods set backDelivery='".$_POST['delivery']."',status='退回' where id='".$_POST['returnID']."'";
    $access="退回";
}else if($_POST['access']=="退款"){
    $sql="select orderID from returnGoods where id='".$_POST['returnID']."'";
    $statement=$db->query($sql);
    $orderID=$statement->fetch(PDO::FETCH_ASSOC)['orderID'];
    $sql="update esteeLauder.order set fail=1 ,status='交易失败' where id='".$orderID."'";
    $statement=$db->prepare($sql);
    $statement->execute();
    $sql="update returnGoods set status='退款' where id='".$_POST['returnID']."'";
    $statement=$db->prepare($sql);
    $statement->execute();
    $sql="select * from ordergoods where id='".$orderID."'";
    $statement=$db->query($sql);
    $returnGoods=$statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($returnGoods as $goods){
        $sql="update productionattr set stock=stock+".$goods['quantity']." where sku='".$goods['sku']."'";
        $statement=$db->prepare($sql);
        $statement->execute();
    }
}


if($_POST['access']!="退款"){
    $statement=$db->prepare($sql);
    $statement->execute();
}

echo $statement->rowCount();
