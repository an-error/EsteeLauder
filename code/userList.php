
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

<table border="1" width="1000px" class="tab">
	<thead>
		<tr>
			<td width="18%">序号</td>
			<td width="18%">姓名</td>
			<td width="18%">手机号码</td>
			<td width="18%">email</td>
			<td width="18%">订单数量</td>
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
            <td><?php echo $row['orderNumber'];?></td>
            <td><input type="button" value="查看"  onclick="seeMore(<?php echo $row['id']?>)" /></td>
		</tr>
	<?php endforeach;?>
	
	</tbody>
</table>
	
	<script>
		function seeMore(id){
		    window.location="userDetail.php?id="+id;
        }
	</script>
</body>
</html>