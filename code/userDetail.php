<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/17
 * Time: 21:45
 */
include('conn.php');
include('module.php');
$id=$_REQUEST['id'];
$sql="select * from user where id=".$id;
$user=$db->query($sql);
$user=$user->fetch(PDO::FETCH_ASSOC);
$sql="select * from address where uid=".$id;
$address=$db->query($sql);
$address=$address->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>

<body>
<div>
    <div id="user">
    <h3>用户信息</h3>
    <p><span>账号：</span><?php echo $id?></p>
    <p><span>姓名：</span><?php echo $user['name']?></p>
    <p><span>手机号码：</span><?php echo $user['phone']?></p>
    <p><span>邮箱：</span><?php echo $user['email']?></p>
    </div>

    <div id="address">
        <h3>收货地址</h3>
        <?php foreach ($address as $row):?>
        <p><span>序号：</span><?php echo $row['id']?></p>
        <p><span>姓名：</span><?php echo $row['name']?></p>
        <p><span>性别：</span><?php echo $row['sex']?></p>
        <p><span>手机号码：</span><?php echo $row['phone']?></p>
        <p><span>地址：</span><?php echo $row['address']?></p>
        <?php endforeach;?>
    </div>

    <div id="order">
        <h3>订单记录</h3>
    </div>


</div>
</body>
</html>

