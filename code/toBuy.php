<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/5
 * Time: 9:41
 */

include("conn.php");
$production=$_POST;

$pname=$_POST['title1'].$_POST['title2'];
$sql="select id from production where name='".$pname."'";
$statement=$db->query($sql);
$pid=$statement->fetch(PDO::FETCH_ASSOC);
$pid=$pid['id'];
session_start();
unset($_SESSION['buy']);
preg_match('/[0-9]+/',$production['price'],$matches);
$production['price']=$matches[0];

if($pname){
    if(!$_POST['stock']){
        $id=$pname.'_'."#ffffff";
        $sql="select stock from productionattr where pid='".$pid."'";   //此sql语句只适合没有色号的商品。
        $statement=$db->query($sql);
        $stock=$statement->fetch(PDO::FETCH_ASSOC);
        $stock=$stock['stock'];
        $production['stock']=$stock;
        $production['count']=1;
        $production['pid']=$pid;

    }else{
        $id=$pname.'_'.$_POST['colour_num'];
        $production['pid']=$pid;
    }


}

$_SESSION['buy'][$id]=$production;
$_SESSION['buyTotal']=$production['price'];
print_r($_SESSION['buy']);