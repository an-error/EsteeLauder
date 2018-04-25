<?php include("module.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css">
        *{
            margin:0;
            padding:0;
        }

        #wrapper{
            width:1705px;
            height:auto;
            position:relative;
        }

        #imgs img{
            width:1705px;
            height:auto;
        }

        #imgs{
            width:1705px;
            overflow: hidden;
            margin:auto;
        }
        #imgs ul{
            list-style-type: none;
            width:11935px;
            position:absolute;
            top:0;
            left:-1703px;
        }

        #button ul{
            list-style-type: none;
            width:100%;
        }

        ul li{
            float:left;
        }

       #button{
           position:absolute;
           top:750px;
           right:50px;
           width:150px;
       }

        #button span{
            display:inline-block;
            width:15px;
            height:15px;
            border-radius: 15px;
            margin-right:10px;
        }

        #pre,#next{
            color:white;
            position:fixed;
            top:350px;
            z-index:10;
            display:none;
        }

        #pre i,#next i{
            font-size:30px;
        }

        #pre{
            transform: rotate(180deg);
        }
        #next{
            right:10px;
        }

        .current{
            background-color: #737373;
        }

        .rest{
            background-color: white;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="imgs">
        <ul >
            <li><a href=""><img src="../image/main-img_04.jpg" alt=""></a></li>
            <li><a href=""><img src="../image/main-img_00.jpg" alt=""></a></li>
            <li><a href=""><img src="../image/main-img_01.jpg" alt=""></a></li>
            <li><a href=""><img src="../image/main-img_02.jpg" alt=""></a></li>
            <li><a href=""><img src="../image/main-img_03.jpg" alt=""></a></li>
            <li><a href=""><img src="../image/main-img_04.jpg" alt=""></a></li>
            <li><a href=""><img src="../image/main-img_00.jpg" alt=""></a></li>

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


<script>

    window.onload=function(){
        var imgs=document.getElementById("imgs");
        var button=document.getElementById('button');
        var imgUL=imgs.getElementsByTagName("ul")[0];
        var buttonUL=button.getElementsByTagName("ul")[0];
        var pre=document.getElementById("pre");
        var next=document.getElementById("next");
        var index=0;
        function action(index){
            console.log(index);
            var li=buttonUL.getElementsByTagName("li");
            for(var i=0;i<li.length;i++){
                li[i].getElementsByTagName("span")[0].classList="rest";
            }
            li[index].getElementsByTagName("span")[0].classList="current";
        }

        pre.onclick=function(){
            imgUL.style.left=(parseInt(imgUL.offsetLeft)+1705)+"px";
            index-=1;
            if(parseInt(imgUL.style.left)>-1705){
                imgUL.style.left=-1705*5+"px";
                index=4;
            }
            action(index);
            //console.log(imgUL.offsetLeft);
        };

        next.onclick=function(){
            imgUL.style.left=(parseInt(imgUL.offsetLeft)-1705)+"px";
            index+=1;
            if(parseInt(imgUL.style.left)<-1705*5){
                imgUL.style.left=-1705+"px";
                index=0;
            }
            action(index);
            //console.log(imgUL.offsetLeft);
        };

        var timer;
        function play(){
            timer=setInterval(function(){
                next.onclick();
            },2000);
        }

        play();
        function stop(){
            clearInterval(timer);
        }

        $("#button li a span").click(function(){
            var imgUl=$("#imgs ul")[0];
            var i=this.getAttribute("index");
            console.log("点击："+(i-1));
            imgUl.style.left=-1705*i+"px";
            console.log(imgUl.style.left);
            index=i-1;
            action(i-1);
        })

        $("#wrapper").mouseover(function(){
            $("#pre").css("display","block");
            $("#next").css("display","block");
        });
        $("#wrapper").mouseout(function(){
            $("#pre").css("display","none");
            $("#next").css("display","none");
        });

    }
</script>
</body>
</html>