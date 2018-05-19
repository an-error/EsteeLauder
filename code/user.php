<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/5
 * Time: 22:18
 */
include("conn.php");
include("minHeader.php");

session_start();
$uid=$_SESSION['id'];

$sql="select * from user where id='".$uid."'";
$statement=$db->query($sql);
$user=$statement->fetch(PDO::FETCH_ASSOC);


$sql="select * from esteelauder.order where status='待付款' and uid='".$uid."'";
$statement=$db->query($sql);
$noPay=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='待发货' and uid='".$uid."'";
$statement=$db->query($sql);
$noManager=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='已签收' and uid='".$uid."'";
$statement=$db->query($sql);
$noComment=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='已发货' and uid='".$uid."'";
$statement=$db->query($sql);
$noReceive=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='交易失败' and uid='".$uid."'";
$statement=$db->query($sql);
$fail=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/user.css" rel="stylesheet"/>
</head>

<body>
    <nav id="anchor">
        <ul>
            <li class="displayOrder"><a href="#order">订单信息</a></li>
            <li><a href="settleAccounts.php?back=1">我的购物车</a></li>
            <li class="displayToBlock"><a >个人信息管理</a></li>
            <li><a href="address.php?just=1">收件人管理</a></li>
        </ul>
    </nav>

    <div id="content">
        <div id="order">
            <div class="user-name"><i class="iconfont icon-gerenzhongxin"></i><span><?php if($user['name']){echo $user['name'];}else{echo $user['phone'];}?></span></div>
            <div class="nav">
                <nav>
                    <ul>
                        <li ><a>已完成</a></li>
                        <li ><a>退款</a></li>
                        <li ><a>待付款</a><span class="order-tip"><?php if($noPay!=0){echo $noPay;}?></span></li>
                        <li><a>待发货</a><span class="order-tip"><?php if($noManager!=0){echo $noManager;}?></span></li>
                        <li><a>待收货</a><span class="order-tip"><?php if($noReceive!=0){echo $noReceive;}?></span></li>
                        <li ><a>待评价</a><span class="order-tip" id="comment"><?php if($noComment!=0){echo $noComment;}?></span></li>
                    </ul>

                </nav>
            </div>
                <div class="show">

                </div>
        </div>

       <div id="userInformation">

           <form ID="<?php echo $user['id']?>">
               <p><span>昵称：</span><input name="name" type="text" placeholder="<?php echo $user['name']?>" /> </p>
               <p><span>手机号码：</span><input name="phone" type="text" placeholder="<?php echo $user['phone']?>" /><i></i></p>
               <p><span>邮箱：</span><input name="email" type="text" placeholder="<?php echo $user['email']?>" /><i></i></p>
               <p><span>密码：</span><input name="password" type="password" placeholder="<?php echo $user['password']?>" /><i></i></p>
               <p class="password2"><span>再次输入密码：</span><input name="password2" type="password" " /><i></i></p>
               <p><input type="button" value="修改" name="revise"/></p>
           </form>
       </div>




    </div>

    <script src="../js/user.js"></script>

</body>
</html>
