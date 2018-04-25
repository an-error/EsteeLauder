<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/5
 * Time: 14:17
 */

include("conn.php");
include("module.php");
$status=array();
$status[0]="待付款";
$status[1]="待发货";
$status[2]="已签收";
$status[3]="已评价";
//echo $_REQUEST['status'];
$sql="select * from esteelauder.order where status='".$status[$_REQUEST['status']]."'";
$statement=$db->query($sql);
$orders=$statement->fetchAll(PDO::FETCH_ASSOC);

if($_REQUEST['status']==3){
    foreach($orders as &$order ){
        $sql="select id from comment where orderID='".$order['id']."'";
        $statement=$db->query($sql);
        $order['commentID']=$statement->fetch(PDO::FETCH_ASSOC)['id'];
    }
}

//print_r($orders);


/*$phone=array();
foreach ($orders as $order){
    $sql="select phone from user where id='".$order['uid']."'";
    $statement=$db->query($sql);
    $name[$order['uid']]=$statement->fetch(PDO::FETCH_ASSOC)['phone'];
}*/

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
        }
        table thead td{
            height:60px;
            border:1px solid #dfe0e1;
        }

        table tbody td{
            height:40px;
            border:1px solid #dfe0e1;
        }
        /*.select{
            position:relative;
        }
        .select-content{
            position:absolute;
            top:40px;
            left:0;
            width:200px;
            display:none;
        }

        .select-content ul{
            list-style-type: none;

        }

        .select-content ul li{
            width:200px;
            text-align: center;
        }*/

        tbody select{
            width:200px;
            height:40px;
            border:none;
        }
    </style>
</head>

<body>

    <table>
        <thead>
        <tr>
            <td width="100px">订单号</td>
            <td width="100px">用户名</td>
            <td width="200px">创建时间</td>
            <td width="200px">状态</td>
            <td width="100px">是否付款</td>
            <td width="100px"></td>
            <?php if($_REQUEST['status']!=3):?>
            <td width="200px">总金额</td>
            <?php endif;?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order):?>
        <tr orderID="<?php echo $order['id']?>">
            <td><?php echo $order['id']?></td>
            <td><?php echo $order['uid']?></td>
            <td><?php echo $order['create_at']?></td>
            <td>
                <select option="<?php echo $order['status']?>">
                    <option>待发货</option>
                    <option>已发货</option>
                    <!--<option>已签收</option>
                    <option>已评论</option>-->
                </select>

                <!--<div class="select-content">
                    <ul>
                        <li>待发货</li>
                        <li>已发货</li>
                    </ul>
                </div></td>-->
            <td><?php echo $order['isPay']?></td>
            <?php if($_REQUEST['status']==3):?>
            <td><a href="commentDetail.php?commentID=<?php echo $order['commentID']?>">详情</a></td>
            <?php else:?>
            <td class="toDetail"><a href="#">详情</a></td>
            <?php endif;?>
            <?php if($_REQUEST['status']!=3):?>
            <td><?php echo $order['total']?></td>
            <?php endif;?>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>




<script>
    /*$("table").on("click","tbody .select",function(e){
        alert("0");
        $(this).find("div").css("display","block");
    })*/

    $(function(){
        $("select").each(function(){
            var value=$(this).attr('option');
            if(value!=="已签收" && value!=="已评价" && value!=="待付款"){
                $(this).val(value);
            }else{
                this.options.length=0;
                var option=$("<option></option>").text(value);
                $(this).append(option);
                $(this).val(value);

            }

        })
    })

    $("table").on("change","select",function(e){
        var data=new FormData();
        var option=this.value;
        data.append("option",option);
        var orderID=e.target.parentNode.parentNode.getAttribute("orderID");
        data.append("orderID",orderID);

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){

            }
        };
        xhr.open("post","updateStatus.php",true);
        xhr.send(data);

    })

    $("table").on("click",".toDetail",function(e){
        var orderID=e.target.parentNode.parentNode.getAttribute("orderID");
        location.href="orderDetail.php?orderID="+orderID;
    })
</script>
</body>
</html>
