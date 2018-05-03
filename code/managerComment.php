<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/9
 * Time: 16:21
 */

include("module.php");
include("conn.php");


$statement=$db->query("select * from comment where isDelete is null ");
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
        <th width="100px">订单号</th>
        <th width="100px">顾客</th>
        <th width="100px">商品编号</th>
        <th width="100px">商品评分</th>
        <th width="100px">服务评分</th>
        <th width="100px">时效评分</th>
        <th width="100px"></th>
        <th width="100px">展示</th>
        <th width="100px">删除</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($result as $r):?>
    <tr commentID="<?php echo $r['id']?>">
        <td><?php echo $r['orderID']?></td>
        <td><?php echo $r['uid']?></td>
        <td><?php echo $r['pid']?></td>
        <td><?php echo $r['goodsScore']?></td>
        <td><?php echo $r['serviceScore']?></td>
        <td><?php echo $r['timeScore']?></td>
        <td><a href="commentDetail.php?commentID=<?php echo $r['id']?>">详情</a></td>
        <td>
        <?php if(!$r['isShow']):?>
        <input type="button" name="show" value="展示" />
        <?php endif;?>
        </td>
        <td><input type="button" name="del" value="删除" /></td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>

<script>
    $("tbody").on("click","input[name='show']",function(){
        var isShow=confirm("是否展示？");
        if(isShow){
            var commentID=$(this.parentNode.parentNode).attr("commentID");
            var data=new FormData();
            data.append("commentID",commentID);
            data.append("action","update");
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                    parent.window.refreshFrame();
                }
            };
            xhr.open("post","commentAction.php",true);
            xhr.send(data);
        }
    });

    $("tbody").on("click","input[name='del']",function(){
        var isDel=confirm("是否删除？");
        if(isDel ){
            var commentID=$(this.parentNode.parentNode).attr("commentID");
            var data=new FormData();
            data.append("commentID",commentID);
            data.append("action","delete");
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                    //document.frames("content").document.location.reload();
                    //refreshFrame();
                    parent.window.refreshFrame();
                }
            };
            xhr.open("post","commentAction.php",true);
            xhr.send(data);
        }
    });

</script>
</body>
</html>
