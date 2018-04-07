<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/7
 * Time: 11:16
 */


include("conn.php");
$sql="select * from user where id='".$_POST['id']."'";
$statement=$db->query($sql);
$user=$statement->fetch(PDO::FETCH_ASSOC);

$updateSql='';
$error=[];

if(!empty($_POST['name'])){
    $updateSql.=" name='".$_POST['name']."'";
}

if(!empty($_POST['phone'])){
    if ( !preg_match( "/^1[34578]{1}\d{9}$/", $_POST['phone'] ) ) {
        $error[ "phone"] = "请输入正确的手机号码";
    }else{
        $statement=$db->query("select phone from user");
        $pArr=$statement->fetchAll(PDO::FETCH_ASSOC);
        $phoneArr=array();
        foreach($pArr as $p){
            $phoneArr[]=$p['phone'];
        }
        if(in_array($_POST['phone'],$phoneArr) && $_POST['phone']!=$user['phone']){
            $error['phone']="此手机号码已注册！";
        }else if($_POST['phone']!=$user['phone']){
            $updateSql.=" phone='".$_POST['phone']."'";
        }

    }
}

if(!empty($_POST['email'])){
    if ( !preg_match( "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ", $_POST['email'] ) ) {
        $error[ "email"]= "请输入正确的邮箱地址";
    }else{
        $statement=$db->query("select email from user");
        $eArr=$statement->fetchAll(PDO::FETCH_ASSOC);
        $emailArr=array();
        foreach($eArr as $e){
            $emailArr[]=$e['email'];
        }
        if(in_array($_POST['email'],$emailArr) && $_POST['email']!=$user['email']){
            $error['email']="此邮箱已注册!";
        }else if($_POST['email']!=$user['email']){
            $updateSql.=" email='".$_POST['email']."'";
        }

    }
}

if ( !empty( $_POST[ "password" ] ) ) {
    if ( !preg_match( "/^[\w\x80-\xff]+$/i", $_POST[ "password" ]  ) ) {
        $error[ "password"]= "密码只能含有英文、数字、汉字";
    }
    if ( !empty( $_POST[ "password2" ] ) ) {
        if ($_POST[ "password2" ] == $_POST[ "password" ]) {
            $updateSql.=" password='".$_POST['password']."'";

        }else{
            $error[ "password2"] = "密码不一致，请重新输入";
        }
    } else {
        $error[ "password2"] = "请再次输入密码";
    }
}

if(empty($error) && $updateSql){
    $sql="update user set ";
    $sql.=$updateSql;
    $sql.=" where id='".$_POST['id']."'";
    $collection['sql']= $sql;

    $statement=$db->prepare($sql);
    $statement->execute();
    if($statement->rowCount()){
        $collection['success']="success";
    }
}else if(!$updateSql && empty($error)){
    $collection['success']="success";
}

$collection['error']=$error;
$collection['post']=$_POST;
echo json_encode($collection);




