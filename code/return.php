<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/13
 * Time: 10:34
 */

include("minHeader.php");
include("module.php");
include("conn.php");

$sql="select * from esteelauder.order where id='".$_REQUEST['orderID']."'";
$statement=$db->query($sql);
$result=$statement->fetch(PDO::FETCH_ASSOC);


$sql="select * from returnGoods where orderID='".$_REQUEST['orderID']."'";
$statement=$db->query($sql);
$return=$statement->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/return.css" rel="stylesheet"/>
</head>

<body>
    <?php if(!$return):?>
    <div class="return-content" orderID="<?php echo $_REQUEST['orderID']?>">
        <fieldset>
            <legend>申请退货</legend>
            <form>
            <p>退货原因：
                <select name="reason">
                    <option>商品破损</option>
                    <option>其他</option>
                </select>
            </p>
            <p>退款金额：<input type="number" name="price" placeholder="<?php echo $result['total']?>"/><span class="error"></span></p>
            <p>退款说明：<input type="text" name="text" /><span class="error"></span></p>
            <div class="fake">
                <input type="file" name="files" multiple onchange="preview(this)"/>
                <i class="iconfont icon-photo"></i>
                <span>上传凭证</span>
                <span class="pull-right">*最多上传3张*</span>
            </div>
            <div class="return-img-content">

            </div>
            <hr/>
            <p class="smail">*除非商品破损否则不允退货*</p>
            <input type="button" value="申请退货" name="apply" class="pull-right"/>
            </form>
        </fieldset>
    </div>

    <?php else:?>
    <div class="return-content" returnID="<?php echo $return['id']?>">
        <fieldset>
            <legend>申请退货</legend>
            <form>
                <p>退货原因：<input type="text" placeholder="<?php echo $return['reason']?>"  disabled="disabled"/></p>
                <p>退款金额：<input type="number" name="price" placeholder="<?php echo $return['price']?>" disabled="disabled"/></p>
                <p>退款说明：<input type="text" name="text" placeholder="<?php echo $return['text']?>" disabled="disabled"/></p>
                <div class="fake">
                    <input type="file" name="files" multiple onchange="preview(this)" disabled="disabled"/>
                    <i class="iconfont icon-photo"></i>
                    <span>凭证</span>
                </div>
                <div class="return-img-content">
                    <img src="<?php echo $return['img0']?>" />
                    <img src="<?php echo $return['img1']?>" />
                    <img src="<?php echo $return['img2']?>" />
                </div>
                <hr/>

                <?php if($return['status']=="申请退货"):?>
                <input type="button" value="等待商家处理" name="wait" class="pull-right"/>
                <?php endif;?>
                <?php if($return['status']=="驳回申请"):?>
                    <p class="info">申请已驳回！</p>
                <?php endif;?>

                <?php if($return['status']=="允许退货"):?>
                    <div class="return-express">
                    <p>等待买家退货<span class="smail space">*只允许寄顺丰*</span></p>
                    <p><input type="radio"  checked/>顺丰速运</p>
                    <p>快递单号：<input type="number"  name="express" /></p>
                        <input type="button" value="寄出" name="delivery" class="pull-right"/>
                    </div>
                <?php endif;?>

                <?php if($return['status']=="买家已寄出"):?>
                    <div class="return-express">
                        <p><input type="radio"  checked/>顺丰速运</p>
                        <p>快递单号：<input type="number"  name="express" placeholder="<?php echo $return['delivery']?>" disabled="disabled"/></p>
                        <input type="button" value="等待商家确认收货"  class="pull-right"/>
                    </div>
                <?php endif;?>

                <?php if($return['status']=="退回"):?>
                    <div>
                        <p class="info">商品经检查发现已使用，已退回</p>
                        <p><input type="radio"  checked/>顺丰速运</p>
                        <p>快递单号：<input type="number"  placeholder="<?php echo $return['backDelivery']?>" disabled="disabled"/></p>

                    </div>

                <?php endif;?>

                <?php if($return['status']=="退款"):?>
                    <p class="info">商家已退款</p>

                <?php endif;?>


                <p class="smail">*除非商品破损否则不允退货*</p>
            </form>
        </fieldset>
    </div>
    <?php endif;?>

    <script src="../js/return.js"></script>
</body>
</html>
