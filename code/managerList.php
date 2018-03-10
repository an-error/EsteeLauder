
<?php
	include('module.php');
	include("conn.php");

	$sql="select id,name,phone,email from manager;";
	$result = mysql_query( $sql ); 
	$rows=array();
	while($row=mysql_fetch_array( $result )){
		$rows[]=$row;
	}
	/*切记mysql_fetch_array取出来的是一维数组，故foreach循环会不能使用关联键，因为foreach把数据都取出来了*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	
	.tab{
		display:block;
		margin:auto;
		margin-top:50px;
		height:auto;
		border:none;
		
	}
	
	.tab td,.tab th{
		border-collapse: collapse;
		border-color:rgba(170,161,161,1.00);
		text-align:center;
		height:30px;
	}
		
</style>
</head>

<body>

<table border="1" width="1000px" class="tab">
	<thead>
		<tr>
			<th width="20%">序号</th>
			<th width="20%">姓名</th>
			<th width="20%">手机号码</th>
			<th width="20%">email</th>
			<th width="200px">操作</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($rows as $row):?>
		<tr>
			<td><?php echo $row['id'];?></td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['phone'];?></td>
			<td><?php echo $row['email'];?></td>
			<td>
				<input type="button" value="编辑"  onclick="editManager(<?php echo $row['id'];?>)"/>
				<input type="button" value="注销" onclick=delManager();/>
			</td>
		</tr>
	<?php endforeach;?>
	
	</tbody>
</table>
	
	<script>
		function editManager(id){
			window.location="editManager.php?id="+id;
		}
	</script>
</body>
</html>