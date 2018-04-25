<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/7
 * Time: 20:09
 */
include("module.php");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        body{
            background-color:black;
            overflow: hidden;
        }
    </style>
</head>

<body>

<script>
    function snow(){
        var flake=document.createElement("div");
        flake.innerHTML='<i class="iconfont icon-xingxing" >';
        //flake.style.cssText="position:absolute;color:rgb("+255*Math.random()+","+255*Math.random()+","+255*Math.random()+");";
        flake.style.cssText="position:absolute;color:gold;";
        var documentHeight=window.innerHeight;
        var documentWidth=window.innerWidth;
        var millisec=100;

        setInterval(function(){
            var startLeft=Math.random()*documentWidth;
            var endLeft=Math.random()*documentWidth;
            var flakeSize=5+20*Math.random();
            var durationTime=4000+7000*Math.random();
            var startOpacity=0.7+0.3*Math.random();
            var endOpacity=0.2+0.2*Math.random();
            var cloneFlake=flake.cloneNode(true);
           /* cloneFlake.style.cssText+='' +
                'left:${startLeft}px;' +
                'opacity: ${startOpacity};' +
                'font-size:${flakeSize}px;' +
                'top:10px;' +
                'transition:${durationTime}ms;';*/

            cloneFlake.style.cssText+='' +
                'left:'+startLeft+'px;' +
                'opacity:'+startOpacity+';' +
                'font-size:'+flakeSize+'px;' +
                'top:10px;' +
                'transition:'+durationTime+'ms;';
            document.body.appendChild(cloneFlake);
            setTimeout(function(){
             /*   cloneFlake.style.cssText+='' +
                    "left:'${endLeft}'px;" +
                    "top:${documentHeight}px;" +
                    "opacity:${endOpacity};";
                cloneFlake.style.cssText=`left:${endLeft}px; `*/
                cloneFlake.style.cssText+='' +
                    'left:'+endLeft+'px;' +
                    'opacity:'+endOpacity+';' +
                    'top:'+documentHeight+'px;';
                //ES6的模板字符串是反引号
                setTimeout(function(){
                    cloneFlake.remove();
                },durationTime);

            },0);//setTimeout的0是4帧
        },10);
    }
    snow();
</script>
</body>
</html>
