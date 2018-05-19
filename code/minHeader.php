<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/26
 * Time: 10:24
 */
include("module.php");
session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>HER</title>
    <link href="../style/minHeader.css" rel="stylesheet"/>
</head>

<body>
<header>
    <img src="../image/152543743228711.jpg" id="logo"/>
    <div id="user-area">
        <input type="text" id="search"/>
        <i class="iconfont icon-Search" id="iconSearch"></i><span>|</span>
        <i class="iconfont user icon-user"  id="login" onclick="action(<?php echo $_SESSION['is_login']?>)"></i><span>|</span>
        <i class="iconfont icon-gift" id="cart" ></i>
        <div id="userSelect">
            <div class="triangle-outer"></div>
            <div class="triangle"></div>
            <ul>
                <!--<li><?php /*echo $_SESSION['user']*/?></li>-->
                <li><i class="iconfont icon-dingdan"></i><a href="user.php">订单详情</a></li>
                <li><i class="iconfont icon-gerenzhongxin"></i><a href="user.php">个人中心</a></li>
                <li onclick="exit();"><i class="iconfont icon-logout" ></i>退出</li>
            </ul>
        </div>
    </div>

    <div id="shopping" is_login="<?php echo $_SESSION['is_login']?>">
        <?php echo $_SESSION['html']?>

    </div>

    <nav>
        <ul >
            <li><a href="index.php">首页</a></li>
            <li class="dropdown" onmouseover="block()" onclick="load('face')"><a> 面部</a></li>
            <li class="dropdown" onmouseover="block()  " onclick="load('lips')"><a> 唇部</a></li>
            <li class="dropdown" onmouseover="block()" onclick="load('eyes')"><a>眼部</a></li>
           <li><a href="hot2.php">明星产品</a></li>
            <li><a href="herStories.php">her Stories</a></li>
        </ul>
    </nav>
    <div class="dropdown-content" >
        <img src="../image/kendall_food.jpg"/>
        <ul>
            <li><a>粉底液</a></li>
            <li><a>粉饼</a></li>
            <li><a>气垫</a></li>
            <li><a>妆前乳</a></li>
            <li><a>腮红</a></li>
            <li><a>遮瑕膏</a></li>
        </ul>
        <br />
        <ul >
            <li><a>唇彩</a></li>
            <li><a>唇线笔</a></li>
            <li><a>唇膏</a></li>
            <li><a>唇釉</a></li>
        </ul>
        <br/>
        <ul>
            <li><a>眼影</a></li>
            <li><a>眼线笔</a></li>
            <li><a>睫毛膏</a></li>
            <li><a>眉笔</a></li>
        </ul>
        <br/>

    </div>
</header>

<div class="background">
<div id="login-pop">
    <div class="close">
        <div class="close-button"><i class="iconfont icon-guanbi"></i></div>
    </div>
    <div id="login-content">
        <form>
            <p id="user"><i class="iconfont user icon-user"></i><input type="text" name="user" placeholder="手机号码/邮箱"/> </p>
            <span class="user-login error"></span>
            <p id="phone"><i class="iconfont icon-phone"></i><input type="text" name="phone" placeholder="手机号码"/></p>
            <span class="phone error"></span>
            <p id="email"><i class="iconfont icon-185078emailmailstreamline"></i><input type="text" name="email" placeholder="邮箱"/> </p>
            <span class="email error"></span>
            <p><i class="iconfont icon-yypassword1"></i><input type="password" name="password" placeholder="密码"/> </p>
            <span class="password error"></span>
            <p id="password2"><i class="iconfont icon-yypassword1" ></i><input type="password" name="password2" placeholder="请再次输入密码"/> </p>
            <span class="password2 error"></span>
        </form>
    </div>
    <div class="login-bottom"><input type="button" name="submit" value="登录"/></div>
    <a href="#" class="register-link">注册</a>
    <a href="#" class="login-link">登录</a>
</div>
</div>
<script src="../js/header.js"></script>

</body>
</html>
