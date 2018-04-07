<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/3
 * Time: 13:11
 */

//print_r($_POST);

include("conn.php");
session_start();
$error=array();

if(!empty($_POST['phone'])){
    if ( !preg_match( "/^1[34578]{1}\d{9}$/", $_POST['phone'] ) ) {
        $error["phone"] = "请输入正确的手机号码";
    }
}else{
    $error['phone']="请输入收件人手机号码！";
}


if(empty($_POST['username'])){
    $error['username']="请输入收件人姓名！";
}

if(empty($_POST['address'])){
    $error['address']="地址不能为空！";
}

if(empty($_POST['postalcode'])){
    $error['postalcode']="邮政编码不能为空！";
}

if(empty($error)){
    $id=$_SESSION['id'];
    $statement=$db->prepare("insert into address(uid,name,phone,address,firstChoice,postalcode) values(:uid,:name,:phone,:address,:firstchoice,:postalcode)");
    $statement=$statement->execute(array(":uid"=>$id,":name"=>$_POST['username'],":address"=>$_POST['address'],":phone"=>$_POST['phone'],":firstchoice"=>1,":postalcode"=>$_POST['postalcode']));
    if($statement){
        $collection['success']="成功";
        $_SESSION['addressID']=$db->lastInsertId();
    }else{
        $collection['fail']="失败";
    }
}

$collection['error']=$error;
$collection['post']=$_POST;
$collection['id']=$_SESSION['id'];
$collection['just']=$_POST['just'];
echo json_encode($collection);

