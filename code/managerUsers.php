
<?php
	include('module.php');
	include("conn.php");


	$result = $db->query( "select * from user;" );
	/*切记mysql_fetch_array取出来的是一维数组，故foreach循环会不能使用关联键，因为foreach把数据都取出来了*/

    ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
    <link href="../style/table.css" rel="stylesheet"/>
</head>

<body>

<table border="1" width="800px" class="tab">
	<thead>
		<tr>
			<td width="25%">序号</td>
			<td width="25%">手机号码</td>
			<td width="25%">email</td>
			<td width="100px">操作</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($result->fetchAll() as $row):?>
		<tr>
			<td><?php echo $row['id'];?></td>
			<td><?php echo $row['phone'];?></td>
			<td><?php echo $row['email'];?></td>
			<td>
				<a href="managerUserDetail.php?id=<?php echo $row['id'];?>">详情</a>
			</td>
		</tr>
	<?php endforeach;?>
	
	</tbody>
</table>
	
	<script>

	</script>
</body>
</html>