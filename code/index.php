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
    <style>
        *{
            margin:0;
            padding:0;
        }

        #wrapper{
            width:1705px;
            height:799px;
            overflow: hidden;
            position:relative;
            margin-bottom: 40px;
        }

        #imgs img{
            width:1705px;
            height:auto;
        }

        #imgs{
            width:1705px;
            height:799px;
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
            position:absolute;
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



        .container{
            width:100%;
        }



        .container .row{
            width:100%;
            padding:30px;
            margin-bottom:40px;
           // border-bottom: 1px solid #dfe0e1;
        }

        .container .row>div{
            position:relative;
        }

        .container .first img{
            width:96%;
            height:96%;
        }


        .second img{
            width:98%;
            height:98%;
            margin-right:40px;
        }

        .cover{
            width:100%;
            height:100%;
            position:absolute;
            top:0;
            left:0;
            background-color: hsla(0,0%,100%,0);;
            z-index:10;
            text-align: center;
            padding-top:25%;
            font-size:25px;
            color:white;
        }

        .cover p{
            margin:0;
        }

        .cover a{
            font-size:12px;
            text-decoration: none;
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


<div class="container">
    <!--<div class="row">
        <div class="col-md-6 "><img src="../image/1。.jpg"/></div>
        <div class="col-md-6 "><img src="../image/28。.jpg"/></div>
    </div>
    <div class="row smail">
        <div class="col-md-4 "><img src="../image/7。.jpg"/></div>
        <div class="col-md-4 "><img src="../image/11。.jpg"/></div>
        <div class="col-md-4 "><img src="../image/28。.jpg"/></div>
    </div>-->

    <div class="row ">
        <div class="col-md-5 first" onclick="location.href='main.php?categories=腮红'">
            <div class="cover"><p>腮红</p><a >shopping now</a></div>
            <img src="../image/SE742_PC_MPP_PCE_Blush_1366x500.jpg"/>
        </div>
        <div class="col-md-5 " onclick="location.href='main.php?categories=eyes'">
            <div class="cover"><p>眼部</p><a href="">shopping now</a></div>
            <img src="../image/04_GLO519_Eye_Glam_pc_MPP_brows_1366x500.jpg"/>
        </div>
    </div>
    <div class="row second">
        <div class="col-md-4 " onclick="location.href='main.php?categories=lips'">
            <div class="cover"><p>口红</p><a>shopping now</a></div>
            <img src="../image/el_prod_PROD29657_558x768_0.jpg"/>
        </div>
        <div class="col-md-4 " onclick="location.href='main.php?categories=face'">
            <div class="cover"><p>粉底</p><a>shopping now</a></div>
            <img src="../image/1.2.1.jpg"/>
        </div>
        <div class="col-md-4 " onclick="location.href='main.php?categories=face'">
            <div class="cover"><p>粉底</p><a>shopping now</a></div>
            <img src="../image/1.3.1.jpg"/>
        </div>
    </div>
</div>

<?php include("footer.php")?>
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
