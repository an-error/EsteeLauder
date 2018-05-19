<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/4
 * Time: 10:24
 */
include("minHeader.php");
include("conn.php");
session_start();
$addressID=$_SESSION['addressID'];
$statement=$db->prepare("select * from address where id=:id");
$statement->bindParam(":id",$addressID,PDO::PARAM_STR);
$statement->execute();
$address=$statement->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/account.css" rel="stylesheet"/>
</head>

<body>

    <div class="address">
        <div class="address-area" >
            <p><span>收件人：</span><?php echo $address['name']?></p>
            <p><span>手机号码：</span><?php echo $address['phone']?></p>
            <p><span>地址：</span><?php echo $address['address']?></p>
        </div>
    </div>

    <div id="shopping-cart">
        <?php if(empty($_SESSION['buy'])):?>
        <?php foreach($_SESSION['cart'] as $cart):?>
            <div class="cart-block" stock="<?php echo $cart['stock']?>">
                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo $cart['img']?>"/>
                    </div>
                    <div class="col-md-7">
                        <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                        <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                        <p>数量：<?php echo $cart['count']?></p>
                        <p class="pull-right">价格：<?php echo $cart['price']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        <?php endif;?>
        <?php if(!empty($_SESSION['buy'])):?>
        <?php foreach($_SESSION['buy'] as $cart):?>
            <div class="cart-block" stock="<?php echo $cart['stock']?>">
                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo $cart['img']?>"/>
                    </div>
                    <div class="col-md-7">
                        <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                        <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                        <p>数量：<?php echo $cart['count']?></p>
                        <p class="pull-right">价格：<?php echo $cart['price']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>

    <div class="account-text">备注：<textarea></textarea></div>

    <div id="account">
        <p>总计：  ￥<?php if(empty($_SESSION['buy'])){echo $_SESSION['total'];}else{echo $_SESSION['buyTotal'];}?></p>
        <div>
        <input type="button" value="返回" name="backToAddress" onclick="location.href='index.php'" />
        <input type="button" value="支付" name="toAccount" />
        </div>
    </div>

<script src="../js/account.js"></script>
</body>
</html>
