<!doctype html>
<?php session_start(); ?>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<link href="../module/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../style/managerLogin.css" rel="stylesheet"/>
</head>

<body>
    <img src="../image/beautiful-bloom-blooming-173665.jpg" id="background"/>

	<div  id="block">
		<img src="../image/152548517261446.png" />
		<form action="managerLoginCheck.php" method="post">

			<p>账号：</p>
			<input class="inputStyle" type="text" name="id"/><br/>
			<p>密码：</p>
			<input class="inputStyle" type="password" name="password"/><br/>
			<input class="btnStyle" type="submit" name="submit" value="登陆"/>

		</form>
	</div>

<script>
    $(function() {
        if (window.history && window.history.pushState) {
            $(window).on('popstate', function () {
                window.history.pushState('forward', null, '#');
                window.history.forward(1);
            });
        }
        window.history.pushState('forward', null, '#'); //在IE中必须得有这两行
        window.history.forward(1);
    })
</script>
</body>
</html>