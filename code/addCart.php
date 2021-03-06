<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/30
 * Time: 22:09
 */


include("conn.php");

$production=array();

if($_POST['title1']){
    $production=$_POST;
    $pname=$_POST['title1'].$_POST['title2'];
    $sql="select id from production where name='".$pname."'";
    $statement=$db->query($sql);
    $pid=$statement->fetch(PDO::FETCH_ASSOC);
    $pid=$pid['id'];
    //print_r($production);
}else{
    $pid=$_POST['pid'];
    $colour_num=$_POST['colour_num'];
    $sql="select * from production where id='".$pid."'";
    $statement=$db->query($sql);
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    $pname=$result['name'];
    preg_match('#[a-zA-Z\s+\d/.]*#',$result['name'],$matches);
    $production['title1']=$matches[0];
    $production['title2']=substr($result['name'],strlen($matches[0]));
    $production['img']=$result['img'];
    $production['size']=$result['size'];
    $sql="select * from productionattr where colour_num='".$colour_num."' and pid='".$pid."'";
    $statement=$db->query($sql);
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    $production['price']=$result['price'];
    $production['stock']=$result['stock'];
    $production['colour_name']=$result['colour_name'];
    $production['colour_num']=$colour_num;
    $production['count']=1;
    //print_r($production);
}



$idInCart=array();
session_start();

if($_SESSION['cart'] && sizeof($_SESSION['cart'])>0){
    foreach($_SESSION['cart'] as $key=>$value){
            if(!in_array($key,$idInCart)){
                $idInCart[]=$key;
            }
    }
}

//print_r($idInCart);

preg_match('/[0-9]+/',$production['price'],$matches);
$production['price']=$matches[0];
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


if($pname){
    if((!$_POST['stock'] && $_POST['title1']) || $production['colour_num']=="#ffffff"){
        $id=$pname.'_'."#ffffff";
        if(in_array($id,$idInCart)){
            if($_SESSION['cart'][$id]['count']<6 && $_SESSION['cart'][$id]['count']<$_SESSION['cart'][$id]['stock']){
                $_SESSION['cart'][$id]['count']++;
                //makeHTML($id,$_SESSION['cart'][$id]['count']);
            }

        }else{
            $sql="select stock from productionattr where pid='".$pid."'";   //此sql语句只适合没有色号的商品。
            $statement=$db->query($sql);
            $stock=$statement->fetch(PDO::FETCH_ASSOC);
            $stock=$stock['stock'];
            $production['stock']=$stock;
            $production['count']=1;
            $production['pid']=$pid;
            $_SESSION['cart'][$id]=$production;
        }


    }else{
        $id=$pname.'_'.$_POST['colour_num'];
        if(in_array($id,$idInCart)){
            if($_SESSION['cart'][$id]['count']<6 && $_SESSION['cart'][$id]['count']<$_SESSION['cart'][$id]['stock']){
                $_SESSION['cart'][$id]['count']++;
            }

        }else{
            $production['pid']=$pid;
            $_SESSION['cart'][$id]=$production;
        }
    }


}

$htmlAll="";
$total=0;
foreach($_SESSION['cart'] as $key=>$value){
    $htmlAll.=setHTML($key,$value['count']);
    $total+=$value['price']*$value['count'];
}

$_SESSION['total']=$total;
$htmlAll.="<p>总计：<span id='cart-total'>"."￥".$total."</span></p>";
$htmlAll.="<input type='button' name='toCount' value='去结算' onclick='toCount()'/>";
$_SESSION['html']=$htmlAll;
$collection['html']=$htmlAll;


echo json_encode($collection);


