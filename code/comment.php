<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/8
 * Time: 8:34
 */
include("conn.php");
include("module.php");
include("minHeader.php");

$sql="select * from ordergoods where id='".$_REQUEST['orderID']."' and sku='".$_REQUEST['sku']."'";
$statement=$db->query($sql);
$goods=$statement->fetch(PDO::FETCH_ASSOC);


$sql="select * from production where id='".$goods['pid']."' ";
$statement=$db->query($sql);
$pid=$statement->fetch(PDO::FETCH_ASSOC);



?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/comment.css" rel="stylesheet"/>
</head>

<body>

    <div id="comment" sku="<?php echo $_REQUEST['sku']?>" orderID="<?php echo $_REQUEST['orderID']?>">
        <div class="comment-area">
            <div class="message">
            <div class="little-content">
                <img src="<?php echo $pid['img']?>"/>
                <div><?php echo $pid['name']?></div>
            </div>

                <textarea placeholder="写下您的感想吧"></textarea>
                <div class="fake">
                    <i class="iconfont icon-photo"><span>晒照片</span><span>最多可上传4张</span></i>
                    <form name="send">
                    <input type="file" name="files" multiple onchange="preview(this)" accept="image/jpeg,image/gif,image/png"/>
                    </form>
                </div>
                <div id="imgContent">

                </div>
            </div>
            <hr/>
            <div class="marking">
                <ul class="one">
                    <li>宝贝与描述相符</li>
                    <li><i class="iconfont icon-xingxing" index="0"></i></li>
                    <li><i class="iconfont icon-xingxing" index="1"></i></li>
                    <li><i class="iconfont icon-xingxing" index="2"></i></li>
                    <li><i class="iconfont icon-xingxing" index="3"></i></li>
                    <li><i class="iconfont icon-xingxing" index="4"></i></li>
                    <li></li>
                </ul>
                <ul class="two">
                    <li>我们的服务态度</li>
                    <li><i class="iconfont icon-xingxing" index="0"></i></li>
                    <li><i class="iconfont icon-xingxing" index="1"></i></li>
                    <li><i class="iconfont icon-xingxing" index="2"></i></li>
                    <li><i class="iconfont icon-xingxing" index="3"></i></li>
                    <li><i class="iconfont icon-xingxing" index="4"></i></li>
                    <li></li>
                </ul>
                <ul class="three">
                    <li>物流的服务质量</li>
                    <li><i class="iconfont icon-xingxing" index="0"></i></li>
                    <li><i class="iconfont icon-xingxing" index="1"></i></li>
                    <li><i class="iconfont icon-xingxing" index="2"></i></li>
                    <li><i class="iconfont icon-xingxing" index="3"></i></li>
                    <li><i class="iconfont icon-xingxing" index="4"></i></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <hr/>
        <input type="button" value="发表评价" name="toComment"/>
    </div>

    <script src="../js/comment.js"></script>

</body>
</html>
