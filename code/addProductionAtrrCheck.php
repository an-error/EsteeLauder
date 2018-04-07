<?php
include("conn.php");

$data=$_POST['data'];
$success=$error="";
$message=[];

$name=$_POST['name'];
$sql="select id from production where name='".$name."'";
$result=$db->query($sql);
$result=$result->fetch();
$pid=$result[0];

/*$pid=27;
$name="Double Wear 雅诗兰黛持妆粉底液 SPF10/PA++";*/

if(is_string($_POST['data'])){
    $data=explode(',',$_POST['data']);
    $data=array_chunk($data,4);
}else{
    $data=$_POST['data'];
}



if(sizeof($data)>1){
    foreach($data as $row){
        if($row[2]<0 || $row[3]<0){
            $error="请输入正数！";
        }else{
            $location=strpos($row[1],"'");
            if($location!==false){
                $pre=substr($row[1],0,$location-1);
                $tail=substr($row[1],$location);
                $row[1]=$pre."\\".$tail;
            }
            $sqlArr[]="colour_name='".$arr[2]."'";
            $sku=$name."_".$row[0];
            $sql="insert into Productionattr(sku,pid,colour_num,colour_name,price,stock)values(:sku,:pid,:colour_num,:colour_name,:price,:stock)";
            $statement=$db->prepare($sql);
            $result=$statement->execute(array(":sku"=>$sku,":pid"=>$pid,"colour_num"=>$row[0],"colour_name"=>$row[1],":price"=>$row[3],":stock"=>$row[2]));
            if($result){
                $success="添加商品属性成功！";
            }
        }
    }
}else{

    if($data[0][2]<0 ||$data[0][3]<0){
        $error="请输入正数！";
    }else{
        $location=strpos($data[0][1],"'");
        if($location!==false){
            $pre=substr($data[0][1],0,$location-1);
            $tail=substr($data[0][1],$location);
            $data[0][1]=$pre."\\".$tail;
        }
        $sku=$name."_".$data[0][0];
        $sql="insert into Productionattr(sku,pid,colour_num,colour_name,price,stock)values(:sku,:pid,:colour_num,:colour_name,:price,:stock)";
        $statement=$db->prepare($sql);
        $result=$statement->execute(array(":sku"=>$sku,":pid"=>$pid,"colour_num"=>$data[0][0],"colour_name"=>$data[0][1],":price"=>$data[0][3],":stock"=>$data[0][2]));
        if($result){
            $success="添加商品成功！";
        }
    }
}




$message['error']=$error;
$message['success']=$success;



echo json_encode($message,true);