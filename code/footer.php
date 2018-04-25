<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/23
 * Time: 13:10
 */

?>
<!doctype html>
<html>
<link href="../module/download/font_609056_k7ahfzzv5eidx6r/iconfont.css" rel="stylesheet"/>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        body{
            width:100%;
            height:100%;
        }
        footer{
            position:relative;
            bottom:0;
            width:100%;
            height:200px;
            border-top:1px solid #dfe0e1;
            margin-top:150px;
        }


        .first>li{
            display:inline-block;
            width:150px;
        }

        .second li{
            width:100%;
        }
        .second>li a{
            color:#a3a5a7;
            display:block;
        }

        .second-icon li{
            width:50px;
            display:inline-block;
        }
        .second-icon  i{
            font-size:30px;
        }
        .weixin img{
            display:none;
            width:150px;
            height:150px;

        }

        #subscribe{
           /* display:inline-block;
            margin-left:300px;*/
            position:absolute;
            top:50px;
            left:50%;
            width:500px;
            height:100px;
        }

        #subscribe p{
            font-size:20px;
        }

        #subscribe input[type='email']{
            width:300px;
            height:40px;
        }

        #subscribe button{
            width:100px;
            height:40px;
            border:none;
            color:white;
            background-color: #262c50;
        }

        .footer{
            width:100%;
            height:40px;
            line-height: 40px;
            padding-left:90%;
            background-color:#f7f7f8;
        }
        footer>div:nth-child(1){
            padding:40px;
            height:160px;
        }

    </style>
</head>

<body>
<footer>
    <div >
<ul class="first">
    <li>关于
        <ul class="second">
            <li><a href="story.php">品牌故事</a></li>
            <li><a href="story.php">公司信息</a></li>
        </ul>
    </li>
    <li>客户服务
        <ul class="second">
            <li><a href="user.php">个人信息</a></li>
            <li><a href="user.php">订单信息</a></li>
        </ul>
    </li>

    <li>我们
        <ul class="second second-icon">
            <li><a href="https://weibo.com/esteelauder?is_hot=1" target="_blank"><i class="iconfont icon-weibo"></i></a></li>
            <li><a><i class="iconfont icon-weixin"></i></a></li>
            <li class="weixin">
                <img src="../image/wechat_logo.jpg"/>
            </li>
        </ul>
    </li>
</ul>
    <div id="subscribe">
        <p>订阅电子期刊</p>
        <input type="email" name="subscribe"/>
        <button name="to-subscribe">订阅</button>
    </div>
    </div>
    <div class="footer">
        <span>@2018 LC版权所有</span>
    </div>
</footer>

<script src="../module/jquery.js" type="text/javascript"></script>
<script>
    $(".second").eq(3).find("li").eq(1).click(function(){
        console.log("hi");
        $(".weixin img").css("display","block");
    })

    $(".weixin img").mouseleave(function(){
        $(".weixin img").css("display","none");
    })

    $("button[name='to-subscribe']").click(function(){
        var email= $("input[name='subscribe']").val();
        console.log(email);
        if(email){
            var regExp=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
            var result=regExp.test(email);
            if(result){
                confirm("谢谢订阅！");
            }
        }
    })


</script>
</body>
</html>
