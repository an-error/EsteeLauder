<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/1
 * Time: 14:07
 */

include("minHeader.php");
session_start();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/settleAccounts.css" rel="stylesheet"/>


</head>

<body style="height:<?php if(empty($_SESSION['buy'])|| empty($_SESSION['cart'])){echo '400px';}?>">

<?php if($_REQUEST['back']):?>
    <p id="backToUser"><a href="user.php">返回</a></p>

<?php else:?>
    <p id="continueShopping"><a href="index.php">继续购物</a></p>
<?php endif;?>
<div id="shopping-cart" style="height:<?php if(empty($_SESSION['cart'])) echo '150px';?>">
    <?php if(empty($_SESSION['buy'])):?>
        <?php if(!empty($_SESSION['cart'])):?>
            <?php foreach($_SESSION['cart'] as $key=>$cart):?>
                <div class="cart-block" stock="<?php echo $cart['stock']?>" sku="<?php echo $key?>">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="<?php echo $cart['img']?>"/>
                        </div>
                        <div class="col-md-7">
                            <p class="pull-right"><i class="iconfont icon-changyonggoupiaorenshanchu del"></i></p>
                            <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                            <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                            <p>数量：<input type="number" min="1" max="6" value="<?php echo $cart['count']?>"/></p>
                            <p class="pull-right">价格：<?php echo $cart['price']?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    <?php endif;?>

    <?php if(!empty($_SESSION['buy'])):?>
        <?php foreach($_SESSION['buy'] as $key=>$cart):?>
            <div class="cart-block" stock="<?php echo $cart['stock']?>" sku="<?php echo $key?>">
                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo $cart['img']?>"/>
                    </div>
                    <div class="col-md-7">
                        <p class="pull-right"><i class="iconfont icon-changyonggoupiaorenshanchu del"></i></p>
                        <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                        <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                        <p>数量:<input type="number" min="1" max="6" value="<?php echo $cart['count']?>"/></p>
                        <p class="pull-right">价格：<?php echo $cart['price']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>




</div>

<div id="account">
    <div>
    <p>账单</p>
    <p>总计：￥<span id="total"><?php if(empty($_SESSION['buy'])){echo $_SESSION['total'];}else{echo $_SESSION['buyTotal'];}?></span></p>
    </div>
    <?php if(!empty($_SESSION['buy'])|| !empty($_SESSION['cart'])):?>
    <input type="button" name="continue" value="继续结账" onclick="toContinue(<?php echo $_SESSION['is_login']?>)"/>
    <?php endif;?>
</div>
<?php include("footer.php")?>
<script src="../js/settleAccounts.js"></script>

</body>
</html>
