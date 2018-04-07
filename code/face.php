<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/27
 * Time: 9:11
 */
include('module.php');
include("conn.php");

$face=$db->query("select * from categories where major='面部'");


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"><img src=""></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>
