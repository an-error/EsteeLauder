<?php  
        if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")  
        {  
		

		
        $ID = $_POST["ID"];  
        $password = $_POST["password"]; 
			  
        if($ID == "" && $password == "")  
        {  
            echo "<script>alert('请输入管理员账号或密码！'); history.go(-1);</script>";  
        }else{  
			
					
            	include("conn.php");
				
               $sql="select ID,password from manager where ID='".$ID."' and password='".$password."'";
			
                
				$result = mysql_query($sql);
				$num=mysql_num_rows($result);
				/*为什么说$result是空值（mysql_fetch_array）又说是boolean（mysql_num_rows）*/
                if($num)  
                {  	
					session_start();
					$row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中  
                	$_SESSION['ID']=$ID;
					echo "<script>alert('登陆成功');history.go(-1);</script>";
					
                }  
                else  
                {  
					echo "<script>alert('账号或密码不正确！');history.go(-1);</script>";
                    
                }  
				mysql_close($conn);
            }  
		}/*else{
			echo "<script>alert('提交不成功！');history.go(-1);</script>";
		}*/
      			
    ?>