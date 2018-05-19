<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/2
 * Time: 14:51
 */

include("conn.php");
include("module.php");
include("minHeader.php");
session_start();


$sql="select * from address where uid='".$_SESSION['id']."'";
$statement=$db->query($sql);
$address=$statement->fetchAll(PDO::FETCH_ASSOC);
$addressCount=sizeof($address);
echo $_REQUEST['just'];
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/address.css" rel="stylesheet"/>
</head>

<body>
    <div id="addReceiver">

        <fieldset>
            <legend><span>1.购物车</span>&lt;<span>2.订单提交</span>&lt;<span>3.付款</span></legend>
            <form >
                <p><span>姓名：</span><input type="text" name="address-username"/><span class="error address-user"></span></p>
                <p><span>手机号码：</span><input type="text" name="address-phone"/><span class="error address-phone"></span></p>
                <div class="info">
                    <div>
                        <select id="s_province" name="s_province"></select>  
                        <select id="s_city" name="s_city" ></select>  
                        <select id="s_county" name="s_county"></select>
                        <script class="resources library" src="area.js" type="text/javascript"></script>

                        <script type="text/javascript">_init_area();</script>
                    </div>
                    <div id="show"></div>
                </div>
                <span class="address-text">详细地址：</span><textarea name="text"></textarea><span class="error address"></span>
                <p><span>邮政编码：</span><input type="text" name="postalcode"/><span class="error postalcode"></span></p>
            </form>


            <hr/>

            <p><input type="radio" checked="checked"/>顺丰速运</p>

            <div class="backOrTo">

            <input type="button" value="返回"  name="address-back"/>
            <input type="button" value="<?php if($_REQUEST['just']){echo '提交';}else{ echo '去付款';}?>"  name="toAccount" just="<?php echo $_REQUEST['just']?>"/>
            </div>

        </fieldset>


    </div>

    <div id="selectAddress">
        <?php if($address):?>

                <?php foreach($address as $a):?>


                <div class="address-area" addressID="<?php echo $a['id'];?>">
                    <p><i class="iconfont icon-guanbi pull-right delAddress"></i></p>
                    <p><i class="iconfont icon-user"></i><span><?php echo $a['name']?></span></p>
                    <p><i class="iconfont icon-phone"></i><?php echo $a['phone']?></p>
                    <p><i class="iconfont icon-shouhuodizhi"></i><?php echo $a['address']?></p>
                </div>
                <?php endforeach;?>

        <?php endif;?>

        <div class="toSelect">
            <?php if($addressCount<4):?>
            <input type="button" value="添加收件人" name="addReceiver"/>
           <?php endif;?>
            <?php if($addressCount>0 ):?>
            <input type="button" value="去付款" name="toAccount2" style="visibility: <?php if($_REQUEST['just']){echo 'hidden';}?>" />
            <?php endif;?>
            <?php if($_REQUEST['just']):?>
                <input type="button" value="返回" name="back" onclick="history.back();"/>
            <?php endif;?>
        </div>


    </div>

    <script src="../js/address.js"></script>
</body>
</html>
