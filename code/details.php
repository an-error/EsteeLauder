<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/27
 * Time: 21:02
 */
include('module.php');
include('conn.php');
include('header.php');

$id=$_REQUEST['id'];
$sql="select * from production where id='".$id."'";
$result=$db->query($sql);
$result=$result->fetch(PDO::FETCH_ASSOC);
//print_r($result);

$sql="select major from categories where minor='".$result['categories']."'";
$major=$db->query($sql);
$major=$major->fetch(PDO::FETCH_ASSOC);

$sql="select * from productionattr where pid='".$id."'";
$color=$db->query($sql);
$color=$color->fetchAll(PDO::FETCH_ASSOC);


$img=array();
$img[]=$result['img'];
if($result['img0']){
    $img[]=$result['img0'];
}
if($result['img1']){
    $img[]=$result['img1'];
}
if($result['img2']){
    $img[]=$result['img2'];
}
if($result['img3']){
    $img[]=$result['img3'];
}
preg_match('#[a-zA-Z\s+\d/.]*#',$result['name'],$matches);
$name=substr($result['name'],strlen($matches[0]));

$sql="select * from comment where pid='".$_REQUEST['id']."' and isShow=1";
$statement=$db->query($sql);
$comment=$statement->fetchAll(PDO::FETCH_ASSOC);
$commentCount=sizeof($comment);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>HER</title>
    <link href="../style/details.css" rel="stylesheet"/>
</head>

<body>
<div class="my-icon-div">
<div class="my-icon" onclick="history.back();"><div></div><a>返回</a></div>
<div class="my-icon detail-icon"><div></div><a href="#detail">详情</a></div>
<div class="my-icon comment-icon"><div></div><a href="#comment">评论</a></div>
</div>

<div id="fence"><?php /*echo $major['major']*/?><!-- &gt --><?php /*echo $result['categories']*/?></div>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <img src="<?php echo $result['img'];?>" id="main-img"/>
        </div>
        <div class="col-md-6 col-md-offset-1">
            <h2 id="title1"><?php echo $matches[0]?></h2>
            <h4 id="title2"><?php echo $name?></h4>
            <?php  if($color[0]['colour_num']!=='#ffffff'):?>
            <div id="color">
                <?php foreach($color as $c):?>
                <span class="border"><span class="colour" style="background-color:<?php echo $c['colour_num'];?>" onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>)"></span></span>
                <? endforeach; ?>
            </div>

            <?php endif;?>
            <div style="margin-top:<?php if($color[0]['colour_num']==='#ffffff'){ echo '120px';}?>"><a href="#detail">商品详情</a><a href="#comment">评价</a></div>
            <div class="content"><p><?php echo $result['size']?></p><p id="price"><?php if($color[0]['colour_num']==='#ffffff'){ echo '￥'.$color[0]['price'];}?></p></div>


            <?php  if($color[0]['colour_num']!=='#ffffff'):?>
            <!--色号选择-->
            <div id="select">
            <div id="color-select">
            <ul >
                <?php foreach($color as $c):?>
                <li onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>)"><span style="background-color:<?php echo $c['colour_num'];?>"></span><?php echo $c['colour_name']?></li>
                <?php endforeach;?>
            </ul>
            </div>
            <div id="name" ><span></span><span></span></div>

            </div>
            <?php endif;?>


            <!--购买-->
            <div id="buy">
                <?php  if($color[0]['colour_num']!=='#ffffff'):?>
               <p>数量: <input type="number" name="count" min="1" max="6" value="1"/>
                   <?php endif;?>
                   <?php if($color[0]['colour_num']!=='#ffffff' || $color[0]['colour_num']=='#ffffff'&& $color[0]['stock']>0): ?>
               <input type="button" name="buy" value="立即购买" />
               <input type="button" name="addToCart" value="加入购物车" />
                   <?php endif;?>
               </p>

            </div>



            <p id="lack" >暂时缺货</p>

        </div>
    </div>

    <!--购物车-->
    <div id="shoppingCart">

    </div>

</div>


<fieldset id="detail">
    <legend>商品详情</legend>
    <textarea><?php echo $result['text']?></textarea>
</fieldset>

<!--评价-->
<fieldset id="comment">
    <legend>评价（共<?php echo $commentCount?>条）</legend>
    <?php foreach($comment as $r):?>
        <div class="comment-content">
            <div class="comment-content-text"><?php echo $r['content']?></div>
            <?php if($r['img0']!=''):?>
                <div class="comment-content-img">
                    <img src="<?php echo $r['img0']?>" />
                    <img src="<?php echo $r['img1']?>" />
                    <img src="<?php echo $r['img2']?>" />
                    <img src="<?php echo $r['img3']?>" />
                    <img src="<?php echo $r['img4']?>" />
                    <div class="comment-content-big-img"></div>
                </div>
            <?php endif;?>
            <div class="comment-content-stars">
                <ul class="one">
                    <li>宝贝与描述相符</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$r['goodsScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
                <ul class="two" >
                    <li>我们的服务态度</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$r['serviceScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
                <ul class="three">
                    <li>物流的服务质量</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$r['timeScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>


            <p><?php echo $r['create_at']?></p>
        </div>
    <?php endforeach;?>

</fieldset>
<?php include("footer.php")?>
<script src="setRGB.js"></script>
<script src="../js/details.js"></script>
</body>
</html>
