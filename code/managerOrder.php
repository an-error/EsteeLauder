<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/5
 * Time: 14:17
 */

include("conn.php");
include("module.php");
$statement=$db->query("select * from esteelauder.order;");
$orders=$statement->fetchAll(PDO::FETCH_ASSOC);


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
        <thead>
        <tr>
            <td width="100px">订单号</td>
            <td width="100px">用户名</td>
            <td width="200px">创建时间</td>
            <td width="200px">状态</td>
            <td width="100px">是否付款</td>
            <td width="100px"></td>
            <td width="200px">总金额</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order):?>
        <tr orderID="<?php echo $order['id']?>">
            <td><?php echo $order['id']?></td>
            <td><?php echo $order['uid']?></td>
            <td><?php echo $order['create_at']?></td>
            <td>
                <select option="<?php echo $order['status']?>">
                    <option>待发货</option>
                    <option>已发货</option>
                </select>
            <td><?php echo $order['isPay']?></td>
            <td class="toDetail"><a href="#">详情</a></td>
            <td><?php echo $order['total']?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <script src="../js/managerOrder.js"></script>
</body>
</html>
