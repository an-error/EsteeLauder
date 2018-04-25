<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/18
 * Time: 10:00
 */

include("conn.php");

$statement=$db->query("select * from production");
$production=$statement->fetchAll(PDO::FETCH_ASSOC);





$arr=array();
$arr1=array();
$arr2=array();
$temp=array();
foreach($production as $p){
    $sql="select * from ordergoods where pid='".$p['id']."'";
    $statement=$db->query($sql);
    $orderCount=$statement->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($orderCount)) {
        foreach ($orderCount as $o) {
            if($arr[$p['id']]){
                $arr[(string)$p['id']]+=intval($o['quantity']);
            }else{
                $arr[$p['id']] =$o['quantity'];
            }

        }
    }
    $temp[$p['id']]=$p['categories'];


};

foreach ($arr as $key=>$value){
    $arr1[]=$key;
    $arr2[]=$value;
}

$collection=array();
$collection['bar']['main']=$arr;
$collection['bar']['key']=$arr1;
$collection['bar']['value']=$arr2;

$statement=$db->query("select * from esteelauder.order where status='已签收' ");
$order=$statement->fetchAll(PDO::FETCH_ASSOC);

$arr=[];
foreach($order as $o){
    $month=substr($o['create_at'],5,2);
    if($month[0]=='0'){
        $month=substr($month,1,1);
    }
    $arr[(int)$month-1]+=$o['total'];
}

$value=[];
for($i=0;$i<12;$i++){
    if($arr[$i]){
        $value[$i]=$arr[$i];
    }else{
        $value[$i]=0;
    }

}

$collection['line']['month']=['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
$collection['line']['value']=$value;

$statement=$db->query("select * from categories");
$categories=$statement->fetchAll(PDO::FETCH_ASSOC);
$eye=$lip=$face=array();
foreach($categories as $c){
    if($c['major']=='眼部'){
        $eye[]=$c['minor'];
    }else if($c['major']=='唇部'){
        $lip[]=$c['minor'];
    }else{
        $face[]=$c['minor'];
    }
}


$statement=$db->query("select  * from ordergoods where id in(select id from esteelauder.order where status='已签收')");
$ordergoods=$statement->fetchAll(PDO::FETCH_ASSOC);
$eyeCount=$lipCount=$faceCount=0;
foreach($ordergoods as $g){
    if(in_array($temp[$g['pid']],$eye)){
        $eyeCount+=$g['quantity'];
    }else if(in_array($temp[$g['pid']],$lip)){
        $lipCount+=$g['quantity'];
    }else{
        $faceCount+=$g['quantity'];
    }
}

$pie=[(object)array("value"=>$eyeCount,"name"=>"眼部"),
    (object)array("value"=>$lipCount,"name"=>"唇部"),
    (object)array("value"=>$faceCount,"name"=>"面部"),
    ];


$collection['pie']=$pie;

echo json_encode($collection);


