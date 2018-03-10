    <!doctype html>  
    <html lang="en">  
    <head>  
        <meta charset="UTF-8">  
        <title>注册</title> 
       
        <style>
			*{
				margin:0;
				padding:0;
			}
			   
      
    		#open_btn {  
        		border:none;
				background-color:white;
    		}  
      
    	#background {   
        	position: fixed;  
        	left: 0;  
        	top: 0;  
       		width: 100%;  
        	height: 100%;  
       		background-color: rgba(255,255,250,0.5);  
			font-family: Arial,Helvetica,sans-serif;  
        	font-size: 17px;  
        	text-align: 1.5;  
       }  
      
    	#div1 {  
        	background:rgb(245,249,224);  
       	 	width: 60%;  
        	z-index: 1;  
        	margin: 5% auto;  
        	overflow: auto;  
			border-radius: 5px;
			text-align: center;
    	}  
      
  
      
    	#div2 {  
			display:block;
        	margin-top:5px;  
        	height: 400px;  
        	padding:20px; 
    	}  
      
    	#close { 
			display:block;
        	padding: 5px;
    	}  
      
    	#close-button {  
        	float: right;  
        	font-size: 30px;  
			color:rgba(247,242,242,1.00);  
        	padding-top: 12px;  
        	cursor: pointer;  
        	padding-right: 15px;  
    	}  
      
    	#foot {  
			display:block;
			height:80px;
        	padding: 5px 0;  
       	 	text-align: center;  
        	color: black;  
			background-color:rgba(0,0,5,0.90);
			text-align: center;
    	}  
      
    #background h2 {  
        margin: 10px 0;  
        color: black;  
        padding-left: 15px;  
    }  
      
     #background h3 { 
        padding-top: 15px;  
    }  
			
			
			.inputStyle{
				display:block;
				width:200px;
				height:30px;
				border-radius:10px;
				border:1px solid rgba(103,102,102,1.00);
				padding-left:10px;
				float:left;
				
			}
			.btnStyle{
				display: inline-block;
				width:100px;
				height:40px;
				border:none;
				color:white;
				font-size:20px;
				margin-top:20px;
				background-color:rgba(27,27,27,1.00);
				border-radius:10px;
			}
			
			#background p{
				display: inline-block;
				width:150px;
				clear:left;
				float:left;
				line-height: 30px;
				margin-right:10px;
				text-align:right;
			}
			.radio{
				display:inline-block;
				width:60px;
				height:30px;
				line-height: 30px;
			}
		
			#contain{
				position:absolute;
				left:520px;
				bottom:280px;
			}
			
			#div2 span{
				display:inline-block;
				width:200px;
				height:30px;
				line-height: 50px;
				color:rgba(232,33,37,1.00);
				text-align:left;
				font-size:14px;
			}
	</style> 
          
    </head>  
    <body>  
       
       <?php
       if ( isset( $_POST[ "submit" ] ) && $_POST[ "submit" ] == "注册" ) {
       	function test_input( $data ) {
       		$data = trim( $data );
       		$data = stripslashes( $data ); //去除斜杠
       		$data = htmlspecialchars( $data ); //去除<、>
       		return $data;
       	}

       	$phone = $password = $password2 = $email = $IDCard = $gender = $name = "";
       	$phoneErr = $passwordErr = $password2Err = $emailErr = $IDCardErr = $genderErr = $nameErr = "";

       	if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
       		if ( !empty( $_POST[ "phone" ] ) ) {
       			$phone = test_input( $_POST[ "phone" ] );
       			if ( !preg_match( "/^1[34578]{1}\d{9}$/", $phone ) ) {
       				$phoneErr = "请输入正确的手机号码";
       			}
       		} else {
       			$phoneErr = "请输入手机号码";
       		}

       		if ( !empty( $_POST[ "password" ] ) ) {
       			$password = test_input( $_POST[ "password" ] );
       			if ( !preg_match( "/^[\w\x80-\xff]+$/i", $password ) ) {
       				$passwordErr = "密码只能含有英文、数字、汉字";
       			}
       		} else {
       			$passwordErr = "请输入密码";
       		}
       		if ( !empty( $_POST[ "password2" ] ) ) {
       			$password2 = test_input( $_POST[ "password2" ] );
       			if ( !( $password2 == $password ) ) {
       				$password2Err = "密码不一致，请重新输入";
       			}
       		} else {
       			$password2Err = "请再次输入密码";
       		}

       		if ( !empty( $_POST[ "name" ] ) ) {
       			$name = test_input( $_POST[ "name" ] );
       		} else {
       			$nameErr = "请输入姓名";
       		}



       		if ( !empty( $_POST[ "email" ] ) ) {
       			$email = test_input( $_POST[ "email" ] );
       			if ( !preg_match( "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ", $email ) ) {
       				$emailErr = "请输入正确的邮箱地址";
       			}
       		} else {
       			$emailErr = "请输入邮箱地址";
       		}

       		/*if ( empty( $_POST[ "gender" ] ) ) {
       			$genderErr = "请选择性别";
       		} else {
       			$gender = test_input( $_POST[ "gender" ] );

       		}*/

       		if ( empty( $_POST[ "IDCard" ] ) ) {
       			$IDCardErr = "请输入正确的身份证号";
       		} else{
				include('isIDCard.php');
				$IDCard=$_POST['IDCard'];
				if(!is_idcard($IDCard)){
					$IDCardErr="请输入正确的身份证号";
				}else{
					$gender=intval(substr($id,16,1));
					if($gender%2==0){
						$gender="女";
					}else{
						$gender="男";
					}

				}
			}

					/*if ( $phoneErr == "" && $passwordErr == "" && $password2Err == "" &&
						$emailErr == "" && $addrErr == "" && $genderErr == "" ) {
						include('conn.php');
						$sql = "INSERT INTO manager (phone, name, 地址,邮箱,性别)
							VALUES
							('$phone','$name','$addr','$email','$gender')";

						$sql2 = "INSERT INTO 用户信息 (手机号码, 密码)
							VALUES
							('$phone','$password')";

						mysql_query( $sql2, $conn );
						mysql_query( $sql, $conn );

						echo "<script>alert('注册成功！'); history.go(-2);</script>";
						mysql_close( $conn );



					}*/
					
					
					if ( $phoneErr == "" && $passwordErr == "" && $password2Err == "" &&
						$emailErr == "" && $IDCardErr == "" && $genderErr == "" ){
						include('conn.php');
						$sql="insert into manager(name,gender,password,IDCard,phone,email)values('$name','$gender','$password','$IDCard','$phone','email')";
						
						if(mysql_query($sql)){
							echo "<script>alert('注册成功！'); </script>";
						}
					
					mysql_close($conn);
				}
			}
			}
			?>
        
        <div id="background" class="back">  
            <div id="div1" class="content">  
                <div id="close">  
                    <span id="close-button">×</span>  
                    
                </div>  
                
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    	<div id="div2">  
                    	<p >手机号码：</p>
                    	<input class="inputStyle" type="text" name="phone"  />
                    	<span class="error">*<?php echo $phoneErr;?></span><br/>
                    	
                    	
                    	<p >密码：</p>
                    	<input class="inputStyle" type="password" name="password" />
                    	<span class="error">*<?php echo $passwordErr;?></span><br/>
                    	
                    	
                    	<p >再次确认密码：</p>
                    	<input class="inputStyle" type="password" name="password2" />
                    	<span class="error">*<?php echo $password2Err;?></span><br/>
                    	
                    	
                    	<p >用户名：</p>
                    	<input class="inputStyle" type="text" name="name"  />
                    	<span class="error"><?php echo $nameErr;?></span><br/>
                    	
                    	<p >邮箱：</p>
                    	<input class="inputStyle" type="text" name="email"  />
                    	<span class="error">*<?php echo $emailErr;?></span><br/>
                    	
                    	<p >身份证号：</p>
                    	<input class="inputStyle" type="text" name="IDCard"  />
                    	<span class="error">*<?php echo $IDCardErr;?></span><br/>
                    	
                    	<!--<p >性别：</p>
                    	<div id="contain">
                    	<div class="radio" id="male"><input type="radio" name="gender" value="male">男</div>
						<div class="radio" id="female"><input type="radio" name="gender" value="female">女</div>
                    	</div>
                    	<span class="error">*<?php echo $genderErr;?></span>-->
                    	
                    	<p >性别：</p>
                    	<input class="inputStyle" type="text" name="gender" placehodlder="<?php echo $gender?>" disabled="disabled" />
                    	
                    	
						</div>
                    	<div id="foot">
                    	<input class="btnStyle" type="submit" name="submit" value="注册" />
                    	</div>  
                    </form>
                  
                
            </div>  
        </div>  
        
        
        
        <script >
			     
    			var close = document.getElementById('close-button');  
      			var footBtn=document.getElementsByClassName("btnStyle");
			
			
      
			close.onmouseover=function(){
				close.style.color="black";
			}
			
			close.onmouseout=function(){
				close.style.color="rgba(247,242,242,1.00)";
			}
			
    		close.onclick = function close() {  
        		div.style.display = "none";  
    		}  
      
    		
			
			footBtn[0].onmouseover=function(){
				this.style.backgroundColor="rgba(245,235,236,1.00)";
				this.style.color="black";
			}
			footBtn[0].onmouseout=function(){ 
				this.style.backgroundColor="rgba(27,27,27,1.00)";
				this.style.color="rgba(249,243,243,1.00)";
			}
			
			
		</script>  
    </body>  
    </html>  