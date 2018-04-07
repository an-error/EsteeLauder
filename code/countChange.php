<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/1
 * Time: 13:42
 */

$id=$_POST['sku'];
$count=$_POST['count'];

session_start();
if(empty($_SESSION['buy'])){
    $_SESSION['cart'][$id]['count']=$count;

    foreach($_SESSION['cart'] as $key=>$value){

        $total+=$value['price']*$value['count'];
        $_SESSION['total']=$total;
    }
}else{
    $_SESSION['buy'][$id]['count']=$count;
    $total=$_SESSION['buy'][$id]['price']*$count;
    $_SESSION['buyTotal']=$total;
}


echo $total;