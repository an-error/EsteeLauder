<?php

	function test_input( $data ) {
		$data = trim( $data );
		$data = stripslashes( $data ); //去除斜杠
		$data = htmlspecialchars( $data ); //去除<、>
		return $data;
	}

	$phone = $password = $password2 = $email = $IDCard = $gender = $name = "";
	$arrErr=array();

if ( !empty( $_POST[ "username" ] ) ) {
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
        $arrErr[ "IDCard"]= "请输入身份证号";
    } else {
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

	
	
	/*if ( is_null($arrErr) ) {
			include( 'conn.php' );
			$sql = "insert into manager(name,gender,password,IDCard,phone,email)
                    values('$name','$gender','$password','$IDCard','$phone','$email')";

			if ( mysql_query( $sql ) ) {
				echo "<script>alert('注册成功！'); </script>";
			}

			mysql_close( $conn );
		} else {
			echo json_encode( $arrErr );
		}*/
/*echo json_encode( $arrErr );*/

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
        }


/*echo json_encode( $arrErr );*/

/*print_r($_POST);*/