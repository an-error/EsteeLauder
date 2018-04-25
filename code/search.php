<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/19
 * Time: 8:58
 */

include("conn.php");
include("module.php");
$search=$_REQUEST['search'];
if(preg_match('/^\d+$/',$search)){
    //找订单号，商品编号
    $sql="select * from esteelauder.order where id like  '%".$search."%'";
    $statement=$db->query($sql);
    $order=$statement->fetchAll();

    $sql="select * from production where id like  '%".$search."%'";
    $statement=$db->query($sql);
    $production=$statement->fetchAll();

}else{
    //找商品
    $sql="select * from production where name like  '%".$search."%'";
    $statement=$db->query($sql);
    $production=$statement->fetchAll();
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>
<style>
    body{
        padding:50px;
    }
    a{
        display:block;
        font-size:25px;
        margin-bottom:40px;
        font-family:STXinwei    ;

    }
</style>
<body>

<div id="search-container">
    <?php if($production):?>
        <?php foreach($production as $p):?>
            <a href="seeProduction.php?id=<?php echo $p['id']?>"><?php echo $p['name']?></a>
        <?php endforeach;?>
    <?php endif;?>

    <?php if($order):?>
    <?php foreach($order as $o):?>
    <a href="orderDetail.php?orderID=<?php echo $o['id']?>">订单：<?php echo $o['id']?></a>
    <?php endforeach;?>
    <?php endif;?>



    <?php ?>
</div>

</body>
</html>
