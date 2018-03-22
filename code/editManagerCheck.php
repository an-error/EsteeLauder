<?php
/*$arr=array_keys(array_map('trim',$_POST));
if(is_null($arr)){
    echo "alert('编辑成功！');history.go(-1); ";
}*/
	function test_input( $data ) {
		$data = trim( $data );
		$data = stripslashes( $data ); //去除斜杠
		$data = htmlspecialchars( $data ); //去除<、>
		return $data;
	}

	$phone = $password = $password2 = $email = $IDCard = $gender = $name = "";
	$arrErr=array();
	/*$sql=array();*/
	$arr=array();

    include('conn.php');
    $id=$_REQUEST['id'];
    $statement=$db->prepare("select * from manager where id=:id");

    $statement->execute(array(':id'=>$id));
    $row=$statement->fetch(PDO::FETCH_ASSOC);

    if($_POST['username']!=$row['name']){
        $name = test_input( $_POST[ "username" ] );
       /* $sql['name']="update manager set name=".$name." where id=".$id;*/
       $arr['name']="name='".$name."'";
    }

    if($_POST['password']!=$row['password']){
        if(empty($_POST['password2'])){
            $arrErr['password']= "请再次输入密码";
        }elseif($_POST['password']!=$_POST['password2']){
                $arrErr['password2']= "密码不一致，请重新输入";
        }else{
            $password=test_input($_POST['password']);
           // $sql['password']="update manager set password=".$password." where id=".$id;
            $arr['password']="password= '".$password."'";
        }
    }

    if($_POST['phone']!=$row['phone']){
        $phone = test_input( $_POST[ "phone" ] );
        if ( !preg_match( "/^1[34578]{1}\d{9}$/", $phone ) ) {
            $arrErr[ "phone"] = "请输入正确的手机号码";
        }else{
            //$sql['phone']="update manager set phone=".$phone." where id=".$id;
            $arr['phone']="phone='".$phone."'";
        }
    }

    if($_POST['IDCard']!=$row['IDCard']){
        include( 'isIDCard.php' );
        $IDCard =test_input($_POST[ 'IDCard' ]);
        if ( !is_idcard( $IDCard ) ) {
            $arrErr[ "IDCard"] = "请输入正确的身份证号";
        } else {
            $gender = intval( substr( $id, 16, 1 ) );
            if ( $gender % 2 == 0 ) {
                $gender = "女";
            } else {
                $gender = "男";
            }
            /*$sql['IDCard']="update manager set IDCard=".$IDCard." where id=".$id;*/
            $arr['IDCard']="IDCard='".$IDCard."'";
            $arr['gender']="gender='".$gender."'";
        }
    }

    if($_POST['email']!=$row['email']){
        $email = test_input( $_POST[ "email" ] );
        if ( !preg_match( "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ", $email ) ) {
            $arrErr[ "email"]= "请输入正确的邮箱地址";
        }else{
            //$sql['email']="update manager set email=".$email." where id=".$id;
            $arr['email']="email='".$email."'";
        }
    }

    if (empty($arrErr)){
        if(!empty($arr)){
            $sql="update manager set ";
            $arr=join(" , ",$arr);
            $sql.=$arr." where id='".$id."'";
            include('conn.php');
            $statement=$db->prepare($sql);
            $result=$statement->execute();
            if($result){
                echo "alert('编辑成功！'); ";
            }else{
                echo "alert('编辑不成功！'); ";
            }
        }else{
            echo "无更新内容！";
        }
    }else{
        echo json_encode( $arrErr );
    }

    /*if(empty($arrErr)){
        include('conn.php');
        foreach($sql as $s){
            $statement=$db->prepare($s);
            $result=$statement->execute();
            if($result){
                echo "alert('注册成功！'); ";
            }else{
                echo "alert('注册不成功！'); ";
            }
        }
    }*/


    /*echo "数据库:";
    print_r($row);
    echo 'post:';
    print_r($_POST);
    echo "update语句：";
    print_r($sql);
    echo "错误提示:";
    print_r($arrErr);*/

    /*print_r($result);*/
    /*print_r($row);*/


/*if ( !empty( $_POST[ "username" ] ) ) {
        $name = test_input( $_POST[ "username" ] );
    } else {
        $arrErr[ "username"] = "请输入姓名";
    }

if ( !empty( $_POST[ "password" ] ) ) {
        $password = test_input( $_POST[ "password" ] );
        if ( !preg_match( "/^[\w\x80-\xff]+$/i", $password ) ) {
            $arrErr[ "password"]= "密码只能含有英文、数字、汉字";
        }
    } else {
        $arrErr[ "password"]= "请输入密码";
    }
    if ( !empty( $_POST[ "password2" ] ) ) {
        $password2 = test_input( $_POST[ "password2" ] );
        if ( !( $password2 == $password ) ) {
            $arrErr[ "password2"] = "密码不一致，请重新输入";
        }
    } else {
        $arrErr[ "password2"] = "请再次输入密码";
    }


    if ( !empty( $_POST[ "phone" ] ) ) {
        $phone = test_input( $_POST[ "phone" ] );
        if ( !preg_match( "/^1[34578]{1}\d{9}$/", $phone ) ) {
            $arrErr[ "phone"] = "请输入正确的手机号码";
        }
    } else {
        $arrErr[ "phone"]= "请输入手机号码";
    }

    if ( empty( $_POST[ "IDCard" ] ) ) {
        $arrErr[ "IDCard"]= "请输入正确的身份证号";
    } else {
        include( 'isIDCard.php' );
        $IDCard = $_POST[ 'IDCard' ];
        if ( !is_idcard( $IDCard ) ) {
            $arrErr[ "IDCard"] = "请输入正确的身份证号";
        } else {
            $gender = intval( substr( $id, 16, 1 ) );
            if ( $gender % 2 == 0 ) {
                $gender = "女";
            } else {
                $gender = "男";
            }

        }
    }

    if ( !empty( $_POST[ "email" ] ) ) {
        $email = test_input( $_POST[ "email" ] );
        if ( !preg_match( "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ", $email ) ) {
            $arrErr[ "email"]= "请输入正确的邮箱地址";
        }
    } else {
        $arrErr[ "email"] = "请输入邮箱地址";
    }

	
	


      if(empty($arrErr)){
          include('conn.php');
            $stmt=$db->prepare("insert into manager(name,gender,password,IDCard,phone,email)
                                          VALUE (:name,:gender,:password,:IDCard,:phone,:email)");
            $result=$stmt->execute(array(':name'=>$name,':gender'=>$gender,':password'=>$password,':IDCard'=>$IDCard,
                                            ':phone'=>$phone,':email'=>$email));
            if($result){
                echo "alert('注册成功！'); ";
            }else{
                echo "alert('注册不成功！'); ";
            }

        }else{
            echo json_encode( $arrErr );
        }*/


/*echo json_encode( $arrErr );*/

/*print_r($_POST);*/