<?php

include("module.php");
include("conn.php");


?>



<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        ul{
            display:block;
            list-style-type: none;
        }

        li{
            float:left;
        }

        .icon-xingxing{
            font-size:50px;
            color:grey;
        }

        .icon-icon-test{
            font-size:50px;
            color:gold;
        }
    </style>
</head>

<body>

<div class="marking">
    <ul>
        <li><i class="iconfont icon-xingxing" index="0"></i></li>
        <li><i class="iconfont icon-xingxing" index="1"></i></li>
        <li><i class="iconfont icon-xingxing" index="2"></i></li>
        <li><i class="iconfont icon-xingxing" index="3"></i></li>
        <li><i class="iconfont icon-xingxing" index="4"></i></li>
    </ul>
</div>

<script>

$(".marking").on("mouseover","i",function(){
    var marking=this.parentNode.parentNode.parentNode;
    var stars=marking.getElementsByTagName("i");
    var index=parseInt(this.getAttribute('index'));
    for(var i=0; i<5;i++ ){
        if(i<index+1){
            stars[i].classList.add("icon-icon-test");
        }else{
            stars[i].classList.remove("icon-icon-test");
        }
    }
});


$(".marking").on("click","i",function(){
    var ul=this.parentNode.parentNode;
    var stars=ul.getElementsByTagName("i");
    var index=parseInt(this.getAttribute('index'));
    for(var i=0; i<5;i++ ){
        if(i<index+1){
            stars[i].classList.add("icon-icon-test");
        }else{
            stars[i].classList.remove("icon-icon-test");
        }
    }
    $(".marking").off("mouseover","i");
    $(".marking").off("mouseout","i");
})



</script>

</body>
</html>