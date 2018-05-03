<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/28
 * Time: 23:31
 */

$user=$_POST;
$error=array();

session_start();
$_SESSION['loginBefore']=session_id();

include("conn.php");

function test_input( $data ) {
    $data = trim( $data );
    $data = stripslashes( $data ); //去除斜杠
    $data = htmlspecialchars( $data ); //去除<、>
    return $data;
}

//用户登录
if($user['login']=="true"){
    if(!empty($user['user'])){
        if(preg_match( "/^1[34578]{1}\d{9}$/", $user['user'] )){
            $phone=$user['user'];
            $sql="select id,password from user where phone='".$phone."'";
            $statement=$db->query($sql);
            $result=$statement->fetch();
            if(!empty($result['id'])){
                if($user['password']===$result['password']){
                    $_SESSION['id']=$result['id'];
                    $_SESSION['user']=$phone;
                    $_SESSION['is_login']=true;
                    $success="登录成功!";
                }else{
                    $error['password']="密码错误！";
                }

            }else{
                //$error['user']="请输入正确的手机号码或者邮箱";
                $register="true";
                $_POST['phone']=$phone;

            }


        }else if(preg_match( "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ", $user['user'] )){
            $email=$user['user'];
            $sql="select id,password from user where email='".$email."'";
            $statement=$db->query($sql);
            $result=$statement->fetch();
            if(!empty($result['id'])) {
                if ($user['password'] === $result['password']) {
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['user']=$email;
                    $_SESSION['is_login']=true;
                    $success = "登录成功!";
                } else {
                    $error['password'] = "密码错误！";
                }
            }else{
                //$error['user']="请输入正确的手机号码或者邮箱";
                $register="true";
                $_POST['email']=$email;
            }
        }else{
            $error['user']="请输入手机号码或者邮箱";
        }
    }else{
        $error['user']="请输入手机号码或者邮箱";
    }

    if(empty($user['password'])){
        $error['password']="请输入密码";
    }

}else{
    //注册

    unset($error['user']);
    unset($error['password']);


    if ( !empty( $_POST[ "phone" ] ) ) {
        $phone = test_input( $_POST[ "phone" ] );
        if ( !preg_match( "/^1[34578]{1}\d{9}$/", $phone ) ) {
            $error[ "phone"] = "请输入正确的手机号码";
        }else{
            $statement=$db->query("select phone from user");
            $pArr=$statement->fetchAll(PDO::FETCH_ASSOC);
            $phoneArr=array();
            foreach($pArr as $p){
                $phoneArr[]=$p['phone'];
            }
            if(in_array($phone,$phoneArr)){
                $error['phone']="此手机号码已注册！";
            }
        }

    } else {
        $error[ "phone"]= "请输入手机号码";
    }

    if ( !empty( $_POST[ "email" ] ) ) {
        $email = test_input( $_POST[ "email" ] );
        if ( !preg_match( "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ", $email ) ) {
            $error[ "email"]= "请输入正确的邮箱地址";
        }else{
            $statement=$db->query("select email from user");
            $eArr=$statement->fetchAll(PDO::FETCH_ASSOC);
            $emailArr=array();
            foreach($eArr as $e){
                $emailArr[]=$e['email'];
            }
            if(in_array($email,$emailArr)){
                $error['email']="此邮箱已注册!";
            }
        }
    } else {
        $error[ "email"] = "请输入邮箱地址";
    }

    if ( !empty( $_POST[ "password" ] ) ) {
        $password = test_input( $_POST[ "password" ] );
        if ( !preg_match( "/^[\w\x80-\xff]+$/i", $password ) ) {
            $error[ "password"]= "密码只能含有英文、数字、汉字";
        }
    } else {
        $error[ "password"]= "请输入密码";
    }
    if ( !empty( $_POST[ "password2" ] ) ) {
        $password2 = test_input( $_POST[ "password2" ] );
        if ( !( $password2 == $password ) ) {
            $error[ "password2"] = "密码不一致，请重新输入";
        }
    } else {
        $error[ "password2"] = "请再次输入密码";
    }

    if(empty($error)){
        $statement=$db->prepare("insert into user(phone,email,password)value(:phone,:email,:password) ");
        $insert=$statement->execute(array(":phone"=>$phone,":email"=>$email,":password"=>$password));
        if($insert){
            $_SESSION['id']=$db->lastInsertId();
            $_SESSION['user']=$phone;
            $_SESSION['is_login']=true;
            $success="注册成功";
        }
    }else{
        $error['fail']="注册失败";
    }

}





$collection=array();
$collection['error']=$error;
$collection['success']=$success;
$collection['register']=$register;
$collection['post']=$_POST;
$collection['is_login']=$_SESSION['is_login'];
$collection['session']=$_SESSION;
echo json_encode($collection);

