<!doctype html>
<?php session_start(); ?>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<link href="../module/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<style>
	
	body{
		padding:7%;
		font-weight:bold;
		font-size:18px;
		line-height: 18px;
		
		
	}	
	
	p{
		display:inline;
		line-height: 20px;
	}
	
	input{
		height:30px;
		margin:10px 0;
	}
	#block{
		display:block;
		position: absolute;
		width:500px;
		height:500px;
		top:10%;
		left:36%;
		text-align: center;
		border-color:rgba(228,177,27,1.00);
		border-style:dashed;
		border-width: thin;
		
	}
	input[type="submit"]{
		width:80px;
		height:30px;
		border:none;
		color:rgba(237,227,227,1.00);
		border-radius: 2px;
		background-color:rgba(40,60,107,1.00);
		margin-top:30px;
	}
	img{
		
		margin:20px auto;
		
	
	}
	#div2{
		width:500px;
		text-align: left;
		position:relative;
		
	}
</style>
</head>

<body>

	<div class="row" id="block">
		<img src="../image/5ebb8acc24636e625352174223b87331.jpeg"/>
		<form action="managerLoginCheck.php" method="post">

			<p>账号：</p>
			<input class="inputStyle" type="text" name="id"/><br/>
			<p>密码：</p>
			<input class="inputStyle" type="password" name="password"/><br/>
			<input class="btnStyle" type="submit" name="submit" value="登陆"/>

		</form>
	</div>
</body>
</html>