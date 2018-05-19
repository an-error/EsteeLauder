<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/8
 * Time: 19:08
 */


include("conn.php");

//print_r($_POST);

$sql="select * from ordergoods where id='".$_POST['orderID']."'";
$statement=$db->query($sql);
$result=$statement->fetch(PDO::FETCH_ASSOC);
$pid=$result['pid'];

$sql="select * from esteeLauder.order where id='".$_POST['orderID']."'";
$statement=$db->query($sql);
$uid=$statement->fetch(PDO::FETCH_ASSOC)['uid'];

/*echo "pid=".$pid;
echo "uid=".$uid;
echo "orderID=".$_POST['orderID'];
echo $_POST['sku'];*/

function upload($name,$tmpName){
    $fileName=$name;
    $fileTmp=$tmpName;
    move_uploaded_file($fileTmp,'../img/'.$fileName);
    return '../img/'.$fileName;
}

$img0=$img1=$img2=$img3=$img4="";
if($_FILES['img0']){
    if($_FILES['img0']['error']==0){
        $img0=upload($_FILES['img0']['name'],$_FILES['img0']['tmp_name']);
    }
}

if($_FILES['img1']){
    if($_FILES['img1']['error']==0){
        $img1=upload($_FILES['img1']['name'],$_FILES['img1']['tmp_name']);
    }
}

if($_FILES['img2']){
    if($_FILES['img2']['error']==0){
        $img2=upload($_FILES['img2']['name'],$_FILES['img2']['tmp_name']);
    }
}

if($_FILES['img3']){
    if($_FILES['img3']['error']==0){
        $img3=upload($_FILES['img3']['name'],$_FILES['img3']['tmp_name']);
    }
}

if($_FILES['img4']){
    if($_FILES['img4']['error']==0){
        $img4=upload($_FILES['img4']['name'],$_FILES['img4']['tmp_name']);
    }
}

if($_POST['text']=='undefined'){
    $_POST['text']="默认好评";
}


$stars=$_POST['stars'];
$stars=explode(',',$_POST['stars']);

$statement=$db->prepare("insert into comment(orderID,pid,sku,uid,goodsScore,serviceScore,timeScore,content,img0,img1,img2,img3,img4)
                  value(:orderID,:pid,:sku,:uid,:goodsScore,:serviceScore,:timeScore,:content,:img0,:img1,:img2,:img3,:img4)");

$statement->execute(array(":orderID"=>$_POST['orderID'],":pid"=>$pid,":sku"=>$_POST['sku'],":uid"=>$uid,":goodsScore"=>$stars[0],":serviceScore"=>$stars[1],":timeScore"=>$stars[2],":content"=>$_POST['text'],":img0"=>$img0,":img1"=>$img1,":img2"=>$img2,":img3"=>$img3,":img4"=>$img4));

if($statement->rowCount()){
    echo "发表成功！";
}

$sql="update esteeLauder.order set status='已评价' where id='".$_POST['orderID']."'";
$statement=$db->prepare($sql);
$statement->execute();


/*
 * ,content,img0,img1,img2,img3,img4
 * ,:content,:img0,:img1,:img2,img3,:img4
 * ,":content"=>$_POST['text'],":img0"=>$img0,":img1"=>$img1,":img2"=>$img2,":img3"=>$img3,":img4"=>$img4
 * */
