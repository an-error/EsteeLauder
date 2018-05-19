
<?php 
	include("module.php");
	include("conn.php");
    $id=$_REQUEST['id'];
    $statement=$db->prepare("select * from manager where id=:id");

    $statement->execute(array(':id'=>$id));
    $row=$statement->fetch(PDO::FETCH_ASSOC);
   /* print_r($row);*/
   //execute返回布尔值！PDOStatement是一个类！

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
    <link href="../style/editManager.css" rel="stylesheet"/>
</head>

<body>
<div id="content">
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">
     <p><span class="text">账号：</span><input type="text" name="" value="<?php echo $row['id']?>" disabled="disabled"/></p>
	<p><span class="text">用户名：</span><input type="text" name="username" value="<?php echo $row['name']?>"/><span class="error"></span></p>
	<p><span class="text">密码：</span><input type="password" name="password" value="<?php echo $row['password']?>"/><span class="error"></span></p>
	<p  id="password2"><span class="text">再次输入密码：</span><input type="password" name="password2"  /><span class="error"></span></p>
	<p><span class="text">手机号码：</span><input type="text" name="phone" value="<?php echo $row['phone']?>"/><span class="error"></span></p>
	<p><span class="text">身份证号码：</span><input type="text" name="IDCard" value="<?php echo $row['IDCard']?>"/><span class="error"></span></p>
	
	<p><span class="text">邮箱：</span><input type="text" name="email" value="<?php echo $row['email']?>" /><span class="error"></span></p>
     <input type="button" value="取消" name="cancel"/>
     <input type="button" value="编辑" name="edit"/>

</form>
</div>

<script id="return"></script>
<script src="../js/editManager.js"></script>

</body>
</html>