<?php
	include('conn.php');
	include('module.php');
	$id=$_REQUEST['id'];
	$sql="select * from manager where id='".$id."'";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	.layout{
		display:block;
		width:400px;
		height:400px;
		border:1px rgba(91,90,90,1.00) solid;
		margin:auto;
		margin-top:40px;
		padding:20px;
		position:relative;
	
	}
	
	tr{
		display:block;
		height:30px;
		margin:10px;
		
	}
	
	th{
		display:block;
		float:left;
		width:80px;
		text-align:right;
		margin-right:10px;
	}
	
	caption{
		font-size:26px;
		
	}
	
	input[type="button"]{
		display:block;
		margin:10px;
	}
	
	input[name="cancel"]{
		margin-left:150px;
	}
	
</style>
</head>

<body>
	<form class="layout">
		<table>
			<caption>管理员档案</caption>
			<tbody>
				<tr>
					<th >账号：</th>
					<td><input type="text" placeholder="<?php echo $row['id']?>"/>
					</td>
				</tr>
				<tr>
					<th >姓名：</th>
					<td><input type="text" placeholder="<?php echo $row['name']?>"/>
					</td>
				</tr>
				<tr>
					<th >密码：</th>
					<td><input type="text" placeholder="<?php echo $row['password']?>"/>
					</td>
				</tr>
				<tr>
					<th>身份证号：</th>
					<td><input type="text" placeholder="<?php echo $row['IDCard']?>"/>
					</td>
				</tr>
				<tr>
					<th >手机号码：</th>
					<td ><input type="text" placeholder="<?php echo $row['phone']?>"/>
					</td>
				</tr>
				<tr>
					<th >邮箱：</th>
					<td><input type="text" placeholder="<?php echo $row['email']?>"/>
					</td>
				</tr>

				<tr>
					<td><input type="button" name="cancel" value="取消"  onclick="javascript:history.go(-1);"/></td>
					<td><input type="button" name="finish" value="完成" onclick="editManger(<?php echo $row['id']?>)"/></td>
				</tr>
			</tbody>
		</table>

	</form>
	<script>
		
	</script>
</body>
</html>