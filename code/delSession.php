<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/1
 * Time: 9:35
 */

session_start();

$id=$_POST['id'];

if(empty($_SESSION['buy'])){
    unset($_SESSION['cart'][$id]);

    $total=0;
    foreach($_SESSION['cart'] as $key=>$value){

        $total+=$value['price']*$value['count'];
    }
}else{
    unset($_SESSION['buy']);
    $total=0;
    $_SESSION['buyTotal']=0;
}


$_SESSION['total']=$total;

echo $total;