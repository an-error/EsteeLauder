<?php
include("conn.php");

$data=$_POST['data'];
$success=$error="";
$message=[];
$jscolor=array();
$datajscolor=array();


$name=$_POST['name'];
$sql="select id from production where name='".$name."'";
$result=$db->query($sql);
$result=$result->fetch();
$pid=$result[0];

$sql="select * from productionAttr where pid='".$pid."'";
$statement=$db->query($sql);
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);



function getSqlArr($jscolor){
    global $db;
    $sql="select * from productionAttr where colour_num='".$jscolor."'";
    $statement=$db->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

if(is_string($_POST['data'])){
    $data=explode(',',$_POST['data']);
    $data=array_chunk($data,5);
}else{
    $data=$_POST['data'];
}


if(sizeof($result)>1){
    foreach($result as $d){
        $jscolor[]=$d['colour_num'];
    }
}else{
    $jscolor[]=$result['colour_num'];
}


if(sizeof($data)>1){
    foreach($data as $d){
        $datajscolor[]=$d[1];
    }
}else{
    $datajscolor[]=$data[1];
}









if(sizeof($result)>1){
    foreach($result as $arr){
        if(!in_array($arr['colour_num'],$datajscolor)){
            $sql="delete from productionattr where sku='".$arr['sku']."'";
            $statement=$db->prepare($sql);
            $statement->execute() or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );
        }
    }
}else{
    $arr=$result[0];
    if(!in_array($arr['colour_num'],$datajscolor)){
        $sql="delete from productionattr where sku='".$arr['sku']."'";
        $statement=$db->prepare($sql);
        $statement->execute() or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );
    }
}

function update($sql){
    global $db;
    $statement=$db->prepare($sql);
    $statement->execute() or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );;
}

if(sizeof($data)>1){
    foreach($data as $arr){
        if($arr[3]<0 || $arr[4]<0){
            $error="请输入正数！";
        }else{
            $sqlArr=array();
            if(in_array($arr[1],$jscolor)){
                $sqlData=getSqlArr($arr[1]);
                if((int)$arr[3]!=(int)$sqlData['stock']){
                    $sqlArr[]="stock='".$arr[3]."'";
                }
                if((int)$arr[4]!=(int)$sqlData['price']){
                    $sqlArr[]="price='".$arr[4]."'";
                }
                if($arr[2]!=$sqlData['colour_name']){
                    $location=strpos($arr[2],"'");
                    if($location!==false){
                        $pre=substr($arr[2],0,$location-1);
                        $tail=substr($arr[2],$location);
                        $arr[2]=$pre."\\".$tail;
                    }
                    $sqlArr[]="colour_name='".$arr[2]."'";
                }
                if(!empty($sqlArr)){
                    $sql="update productionattr set ";
                    $sqlArr=join(" , ",$sqlArr);
                    $sql.=$sqlArr." where colour_num='".$arr[1]."'";
                    update($sql);

                }

            }else{
                $sku=$name."_".$arr[1];
                $sql="insert into Productionattr(sku,pid,colour_num,colour_name,price,stock)values(:sku,:pid,:colour_num,:colour_name,:price,:stock)";
                $statement=$db->prepare($sql);
                $statement->execute(array(":sku"=>$sku,":pid"=>$pid,"colour_num"=>$arr[1],"colour_name"=>$arr[2],":price"=>$arr[4],":stock"=>$arr[3]))
                or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );
            }
        }

    }
}else{
    $arr=$data[0];
    if($arr[2]<0 || $arr[3]<0){
        $error="请输入正数！";
    }else{

        $sqlArr=array();
        if(in_array($arr[1],$jscolor)){
            $sqlData=getSqlArr($arr[1]);
            if((int)$arr[3]!=(int)$sqlData['stock']){
                $sqlArr[]="stock='".$arr[3]."'";
            }
            if((int)$arr[4]!=(int)$sqlData['price']){
                $sqlArr[]="price='".$arr[4]."'";
            }
            if($arr[2]!=$sqlData['colour_name']){
                $location=strpos($arr[2],"'");
                if($location!==false){
                    $pre=substr($arr[2],0,$location);
                    $tail=substr($arr[2],$location);
                    $arr[2]=$pre."\\".$tail;
                }
                $sqlArr[]="colour_name='".$arr[2]."'";
            }
            if(!empty($sqlArr)){
                $sql="update productionattr set ";
                $sqlArr=join(" , ",$sqlArr);
                $sql.=$sqlArr." where colour_num='".$arr[1]."'";
                update($sql);
            }

        }else{
            $sku=$name."_".$arr[1];
            $sql="insert into Productionattr(sku,pid,colour_num,colour_name,price,stock)values(:sku,:pid,:colour_num,:colour_name,:price,:stock)";
            $statement=$db->prepare($sql);
            $statement->execute(array(":sku"=>$sku,":pid"=>$pid,"colour_num"=>$arr[1],"colour_name"=>$arr[2],":price"=>$arr[4],":stock"=>$arr[3]))
            or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );
        }
    }

}







$message['error']=$error;
$message['success']=$success;



echo json_encode($message,true);