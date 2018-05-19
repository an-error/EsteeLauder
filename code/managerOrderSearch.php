<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/5
 * Time: 14:17
 */

include("conn.php");
include("module.php");
$status=array();
$status[0]="待付款";
$status[1]="待发货";
$status[2]="已签收";
$status[3]="已评价";
$status[4]="已发货";
$status[5]="交易失败";
//echo $_REQUEST['status'];
$sql="select * from esteelauder.order where status='".$status[$_REQUEST['status']]."'";
$statement=$db->query($sql);
$orders=$statement->fetchAll(PDO::FETCH_ASSOC);

if($_REQUEST['status']==3){
    foreach($orders as &$order ){
        $sql="select id from comment where orderID='".$order['id']."'";
        $statement=$db->query($sql);
        $order['commentID']=$statement->fetch(PDO::FETCH_ASSOC)['id'];
    }
}


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
            <?php if($_REQUEST['status']!=3):?>
            <td width="200px">总金额</td>
            <?php endif;?>
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
            <?php if($_REQUEST['status']==3):?>
            <td><a href="commentDetail.php?commentID=<?php echo $order['commentID']?>">详情</a></td>
            <?php else:?>
            <td class="toDetail"><a href="#">详情</a></td>
            <?php endif;?>
            <?php if($_REQUEST['status']!=3):?>
            <td><?php echo $order['total']?></td>
            <?php endif;?>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <script src="../js/managerOrder.js"></script>
</body>
</html>
