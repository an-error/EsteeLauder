<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/18
 * Time: 9:18
 */

include("conn.php");
include("module.php");



?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <script src="../module/echarts.js"></script>
    <style>
        #container{
            width:100%;
        }
        #bar{
            width:600px;
            height:400px;
            position:relative;top:100px;
        }

        #pie{
            right:50px;
            width:400px;
            height:400px;
        }

        #line{
            width:1200px;
            height:400px;
        }
    </style>
</head>

<body>

    <div id="container">
        <div id="line"></div>
        <div id="bar" ></div>
        <div id="pie" style="top:-300px;left:800px"></div>
    </div>
    <script src="../js/report.js"></script>
</body>
</html>

