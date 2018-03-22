<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/15
 * Time: 21:55
 */

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <?php include('module.php')?>

</head>
<body>
<div id="app">
    {{message}}
</div>
<script>
    var app=new Vue(
        {
            el:'#app',
            data:{
                message:'hello'
            }
        }
    )
</script>
</body>
</html>
