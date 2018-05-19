<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/26
 * Time: 10:24
 */
include("module.php");
include("header.php");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link href="../style/index.css" rel="stylesheet"/>

</head>

<body>


    <div id="wrapper">
        <div id="imgs">
            <ul >
                <li><a href="main.php?categories=face"><img src="../image/main-img_04.jpg" alt=""></a></li>
                <li><a href="main.php?categories=lips"><img src="../image/main-img_00.jpg" alt=""></a></li>
                <li><a href="main.php?categories=eyes"><img src="../image/main-img_01.jpg" alt=""></a></li>
                <li><a href="hot2.php"><img src="../image/main-img_02.jpg" alt=""></a></li>
                <li><a href="herStories.php"><img src="../image/main-img_03.jpg" alt=""></a></li>
                <li><a href="main.php?categories=face"><img src="../image/main-img_04.jpg" alt=""></a></li>
                <li><a href="main.php?categories=lips"><img src="../image/main-img_00.jpg" alt=""></a></li>

            </ul>
        </div>
        <div class="clear"></div>
        <div id="button">
            <ul >
                <li><a ><span class="current" index="1"></span></a></li>
                <li><a><span class="rest" index="2"></span></a></li>
                <li><a><span class="rest" index="3"></span></a></li>
                <li><a><span class="rest" index="4"></span></a></li>
                <li><a><span class="rest" index="5"></span></a></li>
            </ul>
        </div>
        <div id="pre"><i class="iconfont icon-jiantouyou"></i></div>
        <div id="next"><i class="iconfont icon-jiantouyou"></i></div>
    </div>


<div class="container">
  

    <div class="row ">
        <div class="col-md-5 col-xs-5 first" onclick="location.href='main.php?categories=腮红'">
            <div class="cover"><p>腮红</p><a >shopping now</a></div>
            <img src="../image/SE742_PC_MPP_PCE_Blush_1366x500.jpg"/>
        </div>
        <div class="col-md-5 col-xs-5" onclick="location.href='main.php?categories=eyes'">
            <div class="cover"><p>眼部</p><a >shopping now</a></div>
            <img src="../image/04_GLO519_Eye_Glam_pc_MPP_brows_1366x500.jpg"/>
        </div>
    </div>
    <div class="row second">
        <div class="col-md-4 col-xs-4" onclick="location.href='main.php?categories=lips'">
            <div class="cover"><p>口红</p><a>shopping now</a></div>
            <img src="../image/el_prod_PROD29657_558x768_0.jpg"/>
        </div>
        <div class="col-md-4 col-xs-4" onclick="location.href='main.php?categories=face'">
            <div class="cover"><p>粉底</p><a>shopping now</a></div>
            <img src="../image/1.2.1.jpg"/>
        </div>
        <div class="col-md-4 col-xs-4" onclick="location.href='main.php?categories=face'">
            <div class="cover"><p>粉底</p><a>shopping now</a></div>
            <img src="../image/1.3.1.jpg"/>
        </div>
    </div>
</div>

<?php include("footer.php")?>

<script src="../js/index.js"></script>
</body>
</html>
