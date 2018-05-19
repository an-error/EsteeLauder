<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/8
 * Time: 8:34
 */
include("conn.php");
include("module.php");

$sql="select * from comment where id='".$_REQUEST['commentID']."'";
$statement=$db->query($sql);
$comment=$statement->fetch(PDO::FETCH_ASSOC);




/*$sql="select * from ordergoods where id='".$_REQUEST['orderID']."' and sku='".$_REQUEST['sku']."'";
$statement=$db->query($sql);
$goods=$statement->fetch(PDO::FETCH_ASSOC);*/


$sql="select * from production where id='".$comment['pid']."' ";
$statement=$db->query($sql);
$pid=$statement->fetch(PDO::FETCH_ASSOC);

$sql="select * from productionattr where sku='".$comment['sku']."'";
$statement=$db->query($sql);
$sku=$statement->fetch(PDO::FETCH_ASSOC);



?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        header{
            position:relative;
        }
        #comment{
            width:950px;
            height:auto;
            margin: 100px auto;
            border:1px solid #dfe0e1;
            padding:30px;
        }

        .little-content img{
            width:150px;
            height:180px;
            margin-bottom: 20px;
        }
        .little-content div{
            width:160px;
        }

        .little-content{
            width:200px;
            float:left;
            margin-right:30px;
        }

        .comment-area textarea{
            width:600px;
            height:150px;
            padding:10px;
        }
        .comment-area input[name='show']{
            display:block;
            margin:20px;
        }

        .marking ul{
            display:block;
            list-style-type: none;
            height:50px;
            width:900px;
            line-height:50px;
        }

        .marking li{
            float:left;
        }

        .marking ul li:nth-child(7){
            display:inline-block;
            width:350px;
            height:50px;
            margin-left:100px;
            color:red;
        }

        .marking li:nth-child(1){
            display: inline-block;
            margin-right:30px;
        }

        .marking .icon-xingxing{
            font-size:35px;
            color:grey;
        }

        .marking .icon-icon-test{
            font-size:40px;
            color:gold;
        }
        .marking{
            padding:30px;
            width:900px;
            height:200px;
        }

        #comment input[name='toComment']{
            display:block;
            width:150px;
            height:40px;
            font-size:16px;
            background-color: #265a88;
            color:white;
            border:none;
            margin:40px auto 30px auto;
        }

        .comment-area .message{
            height:350px;
            padding:20px;
        }

        .fake{
            position:relative;
        }
        .fake input{
            opacity:0;
            position:absolute;
            left:260px;
            top:20px;
        }
        .fake .iconfont{
            font-size:40px;
            position:absolute;
            left:260px;
        }

        .fake .iconfont span{
            font-size:15px;
            margin-left:20px;
        }

        .fake .iconfont span:nth-child(2){
            color:grey;
        }

        #imgContent{
            width:650px;
            height:100px;
            //background-color: #265a88;
            margin:80px auto auto 150px;
            position:relative;
        }

        #imgContent img{
            width:100px;
            height:100px;
        }

        /*#imgContent img:nth-child(6){
            width:300px;
            height:350px;
        }*/

        .comment-area .color{
            display: inline-block;
            width:30px;
            height:30px;
            margin-right:50px;
        }

        .comment-detail p{
            line-height: 40px;
        }
        .comment-content-big-img{
            width:300px;
            height:350px;
            position:absolute;
            right:-100px;
            top:150px;
        }

        .comment-content-big-img img{
            width:300px;
            height:350px;
        }

        #comment input{
            width:100px;
            height:30px;
            color:white;
            border:none;
            background-color: #265a88;
            margin-right:50px;
        }

        #comment input[name="back"]{
            margin:30px 50px 30px 350px;
        }
    </style>
</head>

<body>

    <div id="comment" commentID="<?php echo $comment['id']?>">
        <div class="comment-area">
            <div class="message">
            <div class="little-content">
                <img src="<?php echo $pid['img']?>"/>
            </div>

                <div class="comment-detail">
                    <p><?php echo $pid['name']?></p>
                    <?php if($sku['colour_name']!="*"):?>
                    <p><span class="color" style="background-color: <?php echo $sku['colour_num']?>"></span><?php echo $sku['colour_name']?></p>
                    <?php endif;?>
                    <p>评价：<?php echo $comment['content']?></p>

                </div>

                <div id="imgContent">
                    <span>上传的照片：</span>
                    <img src="<?php echo $comment['img0']?>" />
                    <img src="<?php echo $comment['img1']?>" />
                    <img src="<?php echo $comment['img2']?>" />
                    <img src="<?php echo $comment['img3']?>" />
                    <img src="<?php echo $comment['img4']?>" />
                    <div class="comment-content-big-img"></div>
                </div>
            </div>
            <hr/>
            <div class="marking">
                <ul class="one">
                    <li>宝贝与描述相符</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$comment['goodsScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
                <ul class="two" >
                    <li>我们的服务态度</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$comment['serviceScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
                <ul class="three">
                    <li>物流的服务质量</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$comment['timeScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
        </div>
        <hr/>
        <input type="button" name="back" value="返回" onclick="history.go(-1);" />
        <input type="button" name="del" value="删除" />
        <?php /*if(!$_REQUEST['user']):*/?><!--
        <input type="button" name="del" value="删除" />
        --><?php /*endif;*/?>
        <?php if(!$comment['isShow']):?>
            <input type="button" name="show" value="展示" />
        <?php endif;?>
    </div>

    <script>


        $(function(){
            $("img").each(function(){
                if($(this).attr('src')===""){
                    $(this).css("display","none");
                }
            })
        });

        $("#imgContent").on("click","img",function(){
            console.log("0");
            $(".comment-content-big-img").each(function(){
                $(this).css("display","none");
            });
            var path=$(this).attr("src");
            var temp="<img style='width:300px;height:350px;' src='"+path+"'/>";
            $('.comment-content-big-img').html(temp);
            $('.comment-content-big-img').css("display","block");
        });

        $(".comment-content-big-img").mouseleave(function(){
            $(this).css("display","none");
        })

        $("#comment").on("click","input[name='show']",function(){
            var isShow=confirm("是否展示？");
            if(isShow){
                var commentID=$(this.parentNode).attr("commentID");
                var data=new FormData();
                console.log(commentID);
                data.append("commentID",commentID);
                data.append("action","update");
                var xhr=new XMLHttpRequest();
                xhr.onreadystatechange=function(){
                    if(this.readyState===4){
                        window.location.href = document.referrer;
                    }
                };
                xhr.open("post","commentAction.php",true);
                xhr.send(data);
            }
        });

        $("#comment").on("click","input[name='del']",function(){
            var isDel=confirm("是否删除？");
            if(isDel ){
                var commentID=$(this.parentNode).attr("commentID");
                var data=new FormData();
                data.append("commentID",commentID);
                data.append("action","delete");
                var xhr=new XMLHttpRequest();
                xhr.onreadystatechange=function(){
                    if(this.readyState===4){
                        //document.frames("content").document.location.reload();
                        window.location.href = document.referrer;
                    }
                };
                xhr.open("post","commentAction.php",true);
                xhr.send(data);
            }
        });

    </script>

</body>
</html>
