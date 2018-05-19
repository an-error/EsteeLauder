<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/13
 * Time: 18:51
 */
include("conn.php");
include("module.php");


$sql="select * from returnGoods where id='".$_REQUEST['returnID']."'";
$statement=$db->query($sql);
$return=$statement->fetch(PDO::FETCH_ASSOC);


$orderID=$return['orderID'];
$sql="select status,isPay,total, address from esteelauder.order where id='".$orderID."'";
$statement=$db->query($sql);
$result=$statement->fetch(PDO::FETCH_ASSOC);
$status=$result['status'];
$isPay=$result['isPay'];
$total=$result['total'];
$address=$result['address'];


$sql="select * from ordergoods where id='".$orderID."'";
$statement=$db->query($sql);
$orders=$statement->fetchAll(PDO::FETCH_ASSOC);


$name=array();
$pid=array();
$sku=array();
foreach($orders as $order){
    if(!in_array($order['pid'],$pid)){
        $pid[]=$order['pid'];
        $sql="select name,img from production where id='".$order['pid']."'";
        $statement=$db->query($sql);
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        $collection[$order['pid']]['name']=$result['name'];
        $collection[$order['pid']]['img']=$result['img'];
    }

    if(!in_array($order['sku'],$sku)){
        $pid[]=$order['sku'];
        $sql="select price ,colour_name,colour_num from productionattr where sku='".$order['sku']."'";
        $statement=$db->query($sql);
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        $collection[$order['sku']]['price']=$result['price'];
        $collection[$order['sku']]['name']=$result['colour_name'];
        $collection[$order['sku']]['num']=$result['colour_num'];

    }
}


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/managerReturnGoodsDetail.css" rel="stylesheet"/>
</head>

<body>

<div class="content" returnID="<?php echo $return['id']?>">
    <div>
        <h4>订单编号：<?php echo $orderID?></h4>
        <p><span>收货地址：</span><?php echo $address;?></p>
        <p><span>运货方式：</span>顺丰速运</p>
    </div>
    <hr/>
    <table width="900px">
        <thead>
        <tr>
            <td width="200px">商品图片</td>
            <td width="400px">商品名称</td>
            <td width="250px">色号</td>
            <td width="180px">状态</td>
            <td width="150px">单价</td>
            <td width="150px">数量</td>
            <td width="150px">总价</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order):?>
            <tr>
                <td><img src="<?php echo $collection[$order['pid']]['img']?>"/></td>
                <td><?php echo $collection[$order['pid']]['name']?></td>
                <td><span style="background-color:<?php echo $collection[$order['sku']]['num'] ?>"></span><?php echo $collection[$order['sku']]['name']?></td>
                <td><?php echo $status?></td>
                <td>￥<?php echo $collection[$order['sku']]['price']?></td>
                <td><?php echo $order['quantity']?></td>
                <td>￥<?php echo $collection[$order['sku']]['price']*$order['quantity']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <p class="right"><span>订单总金额：</span><?php echo $total;?>元</p>
    <fieldset>
        <legend>申请退货</legend>

        <p>退货原因：<input type="text" placeholder="<?php echo $return['reason']?>"  disabled="disabled"/></p>
        <p>退款金额：<input type="number" name="price" placeholder="<?php echo $return['price']?>" disabled="disabled"/></p>
        <p>退款说明：<input type="text" name="text" placeholder="<?php echo $return['text']?>" disabled="disabled"/></p>

        <div class="return-img-content">
            <p>凭证：</p>
            <img src="<?php echo $return['img0']?>" />
            <img src="<?php echo $return['img1']?>" />
            <img src="<?php echo $return['img2']?>" />
            <div></div>
        </div>
        <hr/>

        <?php if($return["status"]=="申请退货"):?>
        <input type="button" value="驳回申请" name="access" class="pull-right"/>
        <input type="button" value="允许退货" name="access" class="pull-right"/>
        <?php endif;?>
        <?php if($return["status"]=="驳回申请"):?>
        <p class="info">申请已驳回！</p>
        <?php endif;?>

        <?php if($return["status"]=="允许退货"):?>
            <p class="info">等待买家退货</p>

        <?php endif;?>

        <?php if($return['status']=="买家已寄出"):?>
            <div class="return-express">
                <p><input type="radio"  checked/>顺丰速运</p>
                <p>快递单号：<input type="number"  placeholder="<?php echo $return['delivery']?>" disabled="disabled"/></p>

                <div class="display-back">
                    <hr/>
                    <p><input type="radio"  checked/>顺丰速运</p>
                    <p>快递单号：<input type="number"  name="express"/></p>

                </div>
                <input type="button" value="退回"  name="display-back" class="pull-right"/>
                <input type="button" value="确认收货" name="confirm" class="pull-right"/>
            </div>
        <?php endif;?>

        <?php if($return['status']=="退回"):?>
            <div>
                <p><input type="radio"  checked/>顺丰速运</p>
                <p>快递单号：<input type="number"  placeholder="<?php echo $return['backDelivery']?>" disabled="disabled"/></p>
                <p class="info">商品经检查发现已使用，已退回</p>
            </div>

        <?php endif;?>

        <?php if($return['status']=="退款"):?>
            <p class="info">商品无误，已退款回顾客</p>

        <?php endif;?>

        <p class="smail">*除非商品破损否则不允退货*</p>

    </fieldset>
</div>

<script src="../js/managerReturnGoodsDetail.js"></script>
</body>
</html>

