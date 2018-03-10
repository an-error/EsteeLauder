<?php  
        if ( isset( $_POST[ "submit" ] ) && $_POST[ "submit" ] == "登陆" ) {



        	$ID = $_POST[ "ID" ];
        	$password = $_POST[ "password" ];

        	if ( $ID == "" && $password == "" ) {
        		echo "<script>alert('请输入管理员账号或密码！'); history.go(-1);</script>";
        	} else {


        		include( "conn.php" );

        		$sql = "select ID,password,name from manager where ID='" . $ID . "' and password='" . $password . "'";


        		$result = mysql_query( $sql );
        		$num = mysql_num_rows( $result );
        		

        		if ( $num ) {
        			session_start();
        			$row = mysql_fetch_array( $result ); //将数据以索引方式储存在数组中 
        			$_SESSION[ 'name' ] = $row[ 'name' ];
        			echo "<script>window.location.href='managerIndex.php' ;</script>";

        		} else {
        			echo "<script>alert('账号或密码不正确！');history.go(-1);</script>";

        		}
        		mysql_close( $conn );
        	}
        }
        /*else{
        			echo "<script>alert('提交不成功！');history.go(-1);</script>";
        		}*/

        ?>