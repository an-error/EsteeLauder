<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/9
 * Time: 16:21
 */

include("module.php");
include("conn.php");


$statement=$db->query("select * from returnGoods ");
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        table{
            margin:50px auto;
            collapse: none;
            text-align: center;
            border:none;
        }
        table thead th{
            height:50px;
            border:1px solid #dfe0e1;
            text-align:center;
        }

        table tbody td{
            height:40px;
            border:1px solid #dfe0e1;
        }
    </style>
</head>

<body>

<table>
    <thead width="1200px">
    <tr>
        <th width="100px">退货编号</th>
        <th width="100px">订单编号</th>
        <th width="100px">退货原因</th>
        <th width="200px">申请时间</th>
        <th width="100px">状态</th>
        <th width="100px">查看</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($result as $r):?>
    <tr returnID="<?php echo $r['id']?>">
        <td><?php echo $r['id']?></td>
        <td><?php echo $r['orderID']?></td>
        <td><?php echo $r['reason']?></td>
        <td><?php echo $r['create_at']?></td>
        <td><?php echo $r['status']?></td>
        <td><a href="managerReturnGoodsDetail.php?returnID=<?php echo $r['id']?>">详情</a></td>

    </tr>
    <?php endforeach;?>
    </tbody>
</table>

<script>

</script>
</body>
</html>
