<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/1
 * Time: 9:35
 */

session_start();

$id=$_POST['id'];

function setHTML($id,$count){
    $html="<div class='cart-area' stock='".$_SESSION['cart'][$id]['stock']."' sku='".$id."'>";
    $html.="<div class='row'>";
    $html.="<div class='col-md-5'>";
    $html.="<img src='".$_SESSION['cart'][$id]['img']."'/>";
    $html.="</div>";
    $html.="<div class='col-md-7'>";
    $html.="<p>".$_SESSION['cart'][$id]['title2']."</p>";
    $html.="<p>".$_SESSION['cart'][$id]['colour_name']."</p>";
    $html.="<p>数量:<input type='number' min='1' max='6' class='cart-count' value='".$count."'/></p>";
    $html.="<p class='cart-price'>价格：￥".$_SESSION['cart'][$id]['price']."</p>";
    $html.="<p class='pull-right'><i class='iconfont icon-changyonggoupiaorenshanchu'></i></p>";
    $html.="</div></div></div>";
    return $html;
}

if(empty($_SESSION['buy'])){
    unset($_SESSION['cart'][$id]);

    $total=0;
    $html="";
    foreach($_SESSION['cart'] as $key=>$value){
        $total+=$value['price']*$value['count'];
        $html.=setHTML($key,$value['count']);
    }
    if($total){
        $html.="<p>总计：<span id='cart-total'>"."￥".$total."</span></p>";
        $html.="<input type='button' name='toCount' value='去结算' onclick='toCount()'/>";
    }

    $_SESSION['total']=$total;
}else{
    unset($_SESSION['buy']);
    $total=0;
    $_SESSION['buyTotal']=0;
}


$_SESSION['html']=$html;
$_SESSION['total']=$total;
$collection['total']=$total;
$collection['html']=$html;
echo json_encode($collection);