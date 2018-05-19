
<?php 
	include("module.php");
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
    <link href="../style/addManager.css" rel="stylesheet"/>
    <style>

    </style>
</head>

<body>
<div id="content">
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">
	<p><span class="text">用户名：</span><input type="text" name="username" /><span class="error"></span></p>
	<p><span class="text">密码：</span><input type="password" name="password" /><span class="error"></span></p>
	<p><span class="text">再次输入密码：</span><input type="password" name="password2" /><span class="error"></span></p>
	<p><span class="text">手机号码：</span><input type="text" name="phone" /><span class="error"></span></p>
	<p><span class="text">身份证号码：</span><input type="text" name="IDCard" /><span class="error"></span></p>
	
	<p><span class="text">邮箱：</span><input type="text" name="email" /><span class="error"></span></p>
	<input type="button" value="注册" name="submit"/>

</form>
</div>

<script id="return"></script>
<script src="../js/addManager.js"></script>

</body>
</html>