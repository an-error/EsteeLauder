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
    $total=$_SESSION['total'];
    if($_SESSION['cart'][$id]['count']<7 && $count<$_SESSION['cart'][$id]['stock']+1){
        $_SESSION['cart'][$id]['count']=$count;
        $total=0;
        $html="";
        foreach($_SESSION['cart'] as $key=>$value){
            $total+=$value['price']*$value['count'];
            $html.=setHTML($key,$value['count']);
        }
        $html.="<p>总计：<span id='cart-total'>"."￥".$total."</span></p>";
        $html.="<input type='button' name='toCount' value='去结算' onclick='toCount()'/>";
        $_SESSION['html']=$html;

        $_SESSION['total']=$total;
    }

}else{
    $total=$_SESSION['buyTotal'];
    if($_SESSION['buy'][$id]['count']<7 && $count<$_SESSION['buy'][$id]['stock']+1){
        $_SESSION['buy'][$id]['count']=$count;
        $total=$_SESSION['buy'][$id]['price']*$count;
        $_SESSION['buyTotal']=$total;
    }else{
        $count=$_SESSION['buy'][$id]['count'];
    }

}

$collection['total']=$total;
$collection['session']=$_SESSION;
$collection['count']=$count;
echo json_encode($collection);