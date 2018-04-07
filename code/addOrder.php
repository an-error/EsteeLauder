<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/4
 * Time: 14:49
 */

include("conn.php");

session_start();
$uid=$_SESSION['id'];
if(empty($_SESSION['buy'])){
    $cart=$_SESSION['cart'];
    $total=$_SESSION['total'];
}else{
    $cart=$_SESSION['buy'];
    $total=$_SESSION['buyTotal'];
}

$addressID=$_SESSION['addressID'];
$text=$_POST['text'];
$isPay=$_POST['isPay'];
if($_POST['isPay']=="true"){
    $status="待发货";
}else{
    $status="待付款";
}

$sql="select * from address where id='".$_SESSION['addressID']."'";
$statement=$db->query($sql);
$address=$statement->fetch(PDO::FETCH_ASSOC);
$address=$address['name']."，".$address['phone']."，".$address['address'];

$statement=$db->prepare("insert into esteelauder.order(uid,status,isPay,addressID,text,total,address)values(:uid,:status,:isPay,:addressID,:text,:total,:address)");
$statement->execute(array(":uid"=>$uid,":status"=>$status,":isPay"=>$isPay,":addressID"=>$addressID,":text"=>$text,"total"=>$total,":address"=>$address));
$orderID=$db->lastInsertId();





foreach ($cart as $key=>$value){
    $statement=$db->prepare("insert into ordergoods(id,pid,sku,quantity)values(:id,:pid,:sku,:quantity)");
    $statement->execute(array(":id"=>$orderID,":pid"=>$value['pid'],":sku"=>$key,":quantity"=>$value['count']));
    $value['stock']=$value['stock']-$value['count'];
    $sql="update productionattr set stock='".$value['stock']."' where sku='".$key."'";
    echo $sql;
    $statement=$db->prepare($sql);
    $statement->execute();


}

$_SESSION['orderID']=$orderID;

if(empty($_SESSION['buy'])){
    $_SESSION['cart']=[];
}else{
    $_SESSION['buy']=[];
}

$_SESSION['html']="";




