<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/4
 * Time: 22:41
 */

include("conn.php");
$orderID=$_REQUEST['orderID'];
$sql="select status,isPay,total,addressID,address from esteelauder.order where id='".$orderID."'";
$statement=$db->query($sql);
$result=$statement->fetch(PDO::FETCH_ASSOC);
$status=$result['status'];
$isPay=$result['isPay'];
$total=$result['total'];
$address=$result['address'];
//$addressID=$result['addressID'];

$sql="select * from ordergoods where id='".$orderID."'";
$statement=$db->query($sql);
$orders=$statement->fetchAll(PDO::FETCH_ASSOC);



/*$sql="select * from address where id='".$addressID."'";
$statement=$db->query($sql);
$address=$statement->fetch(PDO::FETCH_ASSOC);*/





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




/*print_r($address);
print_r($orders);
print_r($name);*/


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/orderDetail.css" rel="stylesheet"/>
</head>

<body>

    <div class="content">
        <div>
            <p><span>收货地址：</span><?php echo $address ?></p>
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
    </div>

    <input type="button" value="返回" onclick="history.go(-1);"  class="pull-right"/>
</body>
</html>
