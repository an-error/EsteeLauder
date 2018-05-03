<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/9
 * Time: 16:21
 */

include("conn.php");

$statement=$db->query("select * from returnGoods;");
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        table{
            margin:50px auto;
            collapse: none;
            text-align: center;
            border:none;
        }
        table thead th{
            height:50px;
            border:1px solid #dfe0e1;
            text-align:center;
        }

        table tbody td{
            height:40px;
            border:1px solid #dfe0e1;
        }
    </style>
</head>

<body>

<table>
    <thead width="1200px">
    <tr>
        <th width="100px">退货编号</th>
        <th width="100px">订单编号</th>
        <th width="100px">退货原因</th>
        <th width="200px">申请时间</th>
        <th width="100px">状态</th>
        <th width="100px">查看</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($result as $r):?>
        <tr returnID="<?php echo $r['id']?>">
            <td><?php echo $r['id']?></td>
            <td><?php echo $r['orderID']?></td>
            <td><?php echo $r['reason']?></td>
            <td><?php echo $r['create_at']?></td>
            <td><?php echo $r['status']?></td>
            <td><a href="managerReturnGoodsDetail.php?returnID=<?php echo $r['id']?>">详情</a></td>

        </tr>
    <?php endforeach;?>
    </tbody>
</table>


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

<script>

    function toSpecial(number){
        var string=number.toString();
        var flag=string.indexOf('.');
        var length=string.length;
        var first=length%3;
        for(var i=0;i<)
    }
</script>
</body>
</html>

