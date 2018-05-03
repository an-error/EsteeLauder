<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/6
 * Time: 15:18
 */

include("conn.php");



session_start();
$uid=$_SESSION['id'];

$sql="select * from user where id='".$uid."'";
$statement=$db->query($sql);
$user=$statement->fetch(PDO::FETCH_ASSOC);



$orders=array();
function getSqlData($comment){
    global $db,$orders,$uid;
    $sql="select * from esteelauder.order where status='".$comment."' and uid='".$uid."'";
    $statement=$db->query($sql);
    $orders[$comment]=$statement->fetchAll(PDO::FETCH_ASSOC);


    foreach($orders[$comment] as &$f){

        $sql="select * from ordergoods where id='".$f['id']."'";
        $statement=$db->query($sql);
        $goods=$statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($goods as $g){
            $sql="select * from productionattr where sku='".$g['sku']."'";
            $statement=$db->query($sql);
            $production=$statement->fetch(PDO::FETCH_ASSOC);
            $sql=$sql="select * from production where id='".$g['pid']."'";
            $statement=$db->query($sql);
            $p=$statement->fetch(PDO::FETCH_ASSOC);
            $production['pid']=$g['pid'];
            $production['name']=$p['name'];
            $production['img']=$p['img'];
            $production['count']=$g['quantity'];
            $f['sku'][]=$production;
        }
    }

}

$status=$_POST['status'];
getSqlData($status);

//print_r($orders);



$html='';
if($status==='已签收' || $status==='已评价'){
    foreach($orders as $order){
        foreach($order as $o){
            foreach($o['sku'] as $sku){
                $html.='<div class="order-content addCss" sku="'.$sku['sku'].'"><div class="basic">';
                $html.='<span>'. $o["create_at"].'</span>';
                $html.='<span class="orderID">订单号：'. $o["id"].'</span></div>';
                $html.='<div ><table><tbody><tr>';
                $html.='<td width="150px"><img src="'.$sku['img'].'"/></td>';
                $html.='<td width="250px">';
                $html.='<div>'. $sku['name'].'</div>';
                $html.='<p><span style="background-color: '.$sku['colour_num'].'"></span>'.$sku['colour_name'].'</p></td>';
                $html.='<td width="100px">￥'.$sku['price'].'</td>';
                $html.='<td width="100px">'. $sku['count'].'</td>';
                $html.='<td width="100px">￥'. $sku['count']*$sku['price'].'</td>';
                $html.='<td width="400px">';
                if($o['status']=='已签收'){
                    $html.='<div class="fake-comment"><i class="iconfont icon-pingjia"></i><input type="button" value="评价" name="comment" /></div></p>';
                }

                if($o['status']=='已评价'){
                    $sql="select id from comment where pid='".$sku['pid']."'";
                    $statement=$db->query($sql);
                    $statement->execute();
                    $commentID=$statement->fetch(PDO::FETCH_ASSOC)['id'];
                    if($commentID){
                        $html.='<input type="button" value="查看评论" onclick="location.href=\''.'commentDetail.php?commentID='.$commentID.'&user=1\'"'.' /></p>';
                    }
                    }

                $html.='</td>';
                $html.='</tr></tbody></table></div></div>';
            }
        }
    }


}else{
    foreach($orders as $order){
        foreach($order as $o){
            $html.='<div class="order-content addCss padding" >';
            $html.='<div><h4>订单编号：'.$o['id'].'</h4>';
            $html.='<p><span>收货地址：</span>'.$o['address'].'</p>';
            $html.='<p><span>运货方式：</span>顺丰速运</p></div><hr/>';
            $html.='<table width="900px"><thead><tr><td width="200px">商品图片</td><td width="400px">商品名称</td>';
            $html.='<td width="250px">色号</td><td width="180px">状态</td><td width="150px">单价</td><td width="150px">数量</td>';
            $html.='<td width="150px">总价</td></tr></thead><tbody>';
            foreach ($o['sku'] as $sku){
                $html.='<tr><td><img src="'.$sku['img'].'"/></td>';
                $html.='<td>'.$sku['name'].'</td>';
                $html.='<td><span style="background-color:'.$sku['colour_num'].'"></span>'.$sku['colour_name'].'</td>';
                $html.='<td>'. $o['status'].'</td>';
                $html.='<td>￥'.$sku['price'].'</td>';
                $html.='<td>'.$sku['count'].'</td>';
                $html.='<td>￥'.$sku['price']*$sku['count'].'</td></tr>';

            }
            $html.='</tbody></table>';
            $html.='<p class="right"><span>订单总金额：</span>'.$o['total'].'元';
            if($o['status']=='待付款'){
                $html.='<input type="button" value="支付" name="rePay" /></p>';
            }
            if($o['status']=='已发货'){
                $html.='<input type="button" value="确认收货" name="confirm" /></p>';
                $html.='<input type="button" value="退货" name="return" /></p>';
            }

            if($o['status']=='交易失败'){
                $html.='<input type="button" value="交易失败"  /></p>';
            }


            $html.='</div>';
        }

    }
}


echo $html;

