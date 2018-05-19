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
    <link href="../style/table.css" rel="stylesheet"/>
</head>

<body>

<table>
    <thead width="1200px">
    <tr>
        <td width="100px">退货编号</td>
        <td width="100px">订单编号</td>
        <td width="100px">退货原因</td>
        <td width="200px">申请时间</td>
        <td width="100px">状态</td>
        <td width="100px">查看</td>
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
