
<?php
	include('module.php');
	include("conn.php");


	$result = $db->query( "select id,name,phone,email from manager;" );
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

<table border="1" width="1000px" class="tab">
	<thead>
		<tr>
			<td width="20%">序号</td>
			<td width="20%">姓名</td>
			<td width="20%">手机号码</td>
			<td width="20%">email</td>
			<td width="200px">操作</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($result->fetchAll() as $row):?>
		<tr>
			<td><?php echo $row['id'];?></td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['phone'];?></td>
			<td><?php echo $row['email'];?></td>
			<td>
				<input type="button" value="编辑"  onclick="editManager(<?php echo $row['id'];?>)"/>
				<input type="button" value="注销" onclick="delManager(<?php echo $row['id']?>)"/>
			</td>
		</tr>
	<?php endforeach;?>
	
	</tbody>
</table>
	
	<script>
		function editManager(id){
			window.location="editManager.php?id="+id;
		}
		function delManager(id){
		    var isDel=confirm("是否确定要删除此账户？删除之后不可撤回！");
		    if(isDel===true){
                window.location="delManager.php?id="+id;
            }
        }
	</script>
</body>
</html>