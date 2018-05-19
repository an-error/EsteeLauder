<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/5/6
 * Time: 16:08
 */

include("conn.php");
$sql="select * from user where id='".$_REQUEST['id']."'";
$statement=$db->query($sql);
$user=$statement->fetch(PDO::FETCH_ASSOC);

$sql="select * from address where uid='".$_REQUEST['id']."'";
$statement=$db->query($sql);
$address=$statement->fetchAll(PDO::FETCH_ASSOC);

$sql="select * from esteelauder.order where uid='".$_REQUEST['id']."'";
$statement=$db->query($sql);
$order=$statement->fetchAll(PDO::FETCH_ASSOC);
$num=$statement->rowCount();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/managerUserDetail.css" rel="stylesheet"/>
</head>

<body>
    <table width="800px">
        <tr>
            <th>手机号码</th>
            <td><?php echo $user['phone']?></td>
        </tr>
        <tr>
            <th>邮箱</th>
            <td><?php echo $user['email']?></td>
        </tr>
        <tr>
            <th>昵称</th>
            <td><?php if(empty($user['name'])){echo '无';}else{echo $user['name'];}?></td>
        </tr>
        <?php if($address):?>
        <?php $i=0;foreach ($address as $temp):$i++; ?>
                <tr>
                    <th>收件人<?php echo $i?>:</th>
                    <td><?php echo $temp['name'].','.$temp['phone'].','.$temp['address'];?></td>
                </tr>
        <?php endforeach;?>
        <?php endif;?>
        <tr>
            <th>订单总数：</th>
            <td><?php echo $num?></td>
        </tr>
        <?php if($num):?>
        <tr>
            <th>订单：</th>
            <td>
            <?php foreach ($order as $temp):?>
               <a href="orderDetail.php?orderID=<?php echo $temp['id'];?>"><?php echo $temp['id'];?></a>
            <?php endforeach;?>
            </td>
        </tr>
        <?php endif;?>
        <tr>
            <th>创建时间：</th>
            <td><?php echo $user['created_at']?></td>
        </tr>
    </table>
    <button onclick="history.go(-1);" >返回</button>
</body>
</html>
