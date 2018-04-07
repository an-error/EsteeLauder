<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/27
 * Time: 21:02
 */
include('module.php');
include('conn.php');
include('header.php');

$id=$_REQUEST['id'];
$sql="select * from production where id='".$id."'";
$result=$db->query($sql);
$result=$result->fetch(PDO::FETCH_ASSOC);
//print_r($result);

$sql="select major from categories where minor='".$result['categories']."'";
$major=$db->query($sql);
$major=$major->fetch(PDO::FETCH_ASSOC);

$sql="select * from productionattr where pid='".$id."'";
$color=$db->query($sql);
$color=$color->fetchAll(PDO::FETCH_ASSOC);
/*$colour_num=array();
if(sizeof($color)!==0){
    foreach($color as $c){
        $colour_num[]=$c['colour_num'];
    }
}else if($color[0]['colour_num']!=="#ffffff"){
    $colour_num[]=$color[0]['colour_num'];
}*/

$img=array();
$img[]=$result['img'];
if($result['img0']){
    $img[]=$result['img0'];
}
if($result['img1']){
    $img[]=$result['img1'];
}
if($result['img2']){
    $img[]=$result['img2'];
}
if($result['img3']){
    $img[]=$result['img3'];
}
preg_match('#[a-zA-Z\s+\d/.]*#',$result['name'],$matches);
$name=substr($result['name'],strlen($matches[0]));


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        #fence{
            //border-bottom: 1px solid grey;
            height:40px;
            line-height: 40px;
            padding-left:20px;
            margin-bottom: 30px;
        }

        .row img{
            width:400px;
            height:500px;
        }
        #color{
            margin:70px auto 40px auto;
        }
        .colour{
            display:inline-block;
            width:30px;
            height:30px;
            border-radius: 20px;
            margin-left:20px;

        }
        /*.border{
            width:35px;
            height:35px;
            border-radius: 30px;
        }
*/
        #color .colour:hover{
            box-shadow: 0 0 5px grey;
        }



        #background{
            width:100%;
            height:100%;
            background-color:rgba(139,138,138,0.50);
            opacity: 50;
            position:fixed;
            top:0;
            left:0;
            display:none;
            z-index:200;
          }

        #pop{
            width:700px;

            background-color: white;
            position:absolute;
            left:30%;
            top:20%;
            box-shadow:0 0 10px #104E8B;
        }

        #close{
            height:50px;
            margin-bottom: 30px;
        }

        #close-button{
            position:absolute;
            right:0;
            top:0;
            width:30px;
            height:30px;
            border:none;
            background-color:white;
        }

        .pop-content{
            margin-bottom:70px;
            padding:20px;
        }

        #close-button:hover{
            color:red;
        }
        #price{

            margin-left:20px;
        }

        .content p{
            display:inline-block;
        }

        .content{
            margin:30px auto;
        }

        #color-select span{
            display:inline-block;
            width:30px;
            height:30px;
            border-radius: 20px;
            margin-right:20px;
        }

        #select{
            position:relative;
            z-index:99;
        }

        #color-select{
            line-height: 45px;
            font-size:18px;
            width:400px;
            height:200px;
            overflow-y: scroll;
            display:none;
            position:absolute;
            bottom:60px;
            background-color: white;

        }

        #color-select li:hover{
            background-color:ghostwhite;
        }
        #name{
            line-height: 45px;
            font-size:18px;
            width:400px;
            height:45px;
            border:1px solid grey;
            margin-bottom:20px;
        }

        #name span:nth-child(1){
            display:inline-block;
            width:30px;
            height:30px;
            border-radius: 20px;
            margin:5px 10px auto auto;
        }

        #buy input{
            display:inline-block;
            margin-right:10px;

        }

        #buy input[type='button']{
            background-color:#333333;
            color:white;
            border:none;
            height:35px;
        }

        input[name="buy"]{
            width:110px;
        }

        input[name="addToCart"]{
            width:170px;
        }

        .lack{
            display:none;
            color: #EE2C2C;
            margin:20px auto;
        }
    </style>
</head>

<body>
<div id="fence"><?php echo $major['major']?> &gt <?php echo $result['categories']?></div>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <img src="<?php echo $result['img'];?>" id="main-img"/>
        </div>
        <div class="col-md-6 col-md-offset-1">
            <h2 id="title1"><?php echo $matches[0]?></h2>
            <h4 id="title2"><?php echo $name?></h4>
            <?php  if($color[0]['colour_num']!=='#ffffff'):?>
            <div id="color">
                <?php foreach($color as $c):?>
                <span class="border"><span class="colour" style="background-color:<?php echo $c['colour_num'];?>" onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>)"></span></span>
                <? endforeach; ?>
            </div>

            <?php endif;?>
            <div style="margin-top:<?php if($color[0]['colour_num']==='#ffffff'){ echo '120px';}?>"><a id="detail">商品详情</a></div>
            <div class="content"><p><?php echo $result['size']?></p><p id="price"><?php if($color[0]['colour_num']==='#ffffff'){ echo '￥'.$color[0]['price'];}?></p></div>

            <?php  if($color[0]['colour_num']!=='#ffffff'):?>
            <!--色号选择-->
            <div id="select">
            <div id="color-select">
            <ul >
                <?php foreach($color as $c):?>
                <li onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>)"><span style="background-color:<?php echo $c['colour_num'];?>"></span><?php echo $c['colour_name']?></li>
                <?php endforeach;?>
            </ul>
            </div>
            <div id="name" ><span></span><span></span></div>

            </div>
            <?php endif;?>


            <!--购买-->
            <div id="buy">
                <?php  if($color[0]['colour_num']!=='#ffffff'):?>
               <p>数量: <input type="number" name="count" min="1" max="6" value="1"/>
                   <?php endif;?>
               <input type="button" name="buy" value="立即购买" />
               <input type="button" name="addToCart" value="加入购物车" />
               </p>

            </div>

            <p class="lack">暂时缺货</p>


            <?php /*if($result['stock']<0):*/?><!--
            <p class="center" style="color:red">暂时缺货</p>
            --><?php /*endif;*/?>

        </div>
    </div>

    <!--购物车-->
    <div id="shoppingCart">

    </div>

</div>
<!--商品详情-->
<div id="background">
    <div id="pop">
        <div id="close">
            <button id="close-button">X</button>
        </div>
        <div class="pop-content">
            <?php echo $result['text']?>
        </div>
    </div>
</div>


<script src="setRGB.js"></script>
<script>
    $("#detail").click(function(){
        $("#background").css("display","block");
    });

    $("#close-button").click(function(){
        $("#background").css("display","none");
    });

    //点击背景时display：
    var background=document.getElementById("background");
    var loginBackground=document.getElementsByClassName('background')[0];
    var shopping=document.getElementById('shopping');
    window.onclick=function(e){

        if(e.target===background){
            background.style.display="none";
        }
        if(e.target===loginBackground){
            loginBackground.style.display="none";
        }
        if(e.target===shopping){
            shopping.style.display="none;"
        }


    };

    function colour(price,stock,name,color){
        $("#price").html("￥"+price);
        $("#name span:first").css('background-color',color);
        $("#name span:last").text(name);
        $("#buy").attr('stock',stock);
        if(stock===0){
            $("#buy").css("display","none");
            $(".lack").css("display",'block');
        }else{
            $("#buy").css("display","block");
            $(".lack").css("display",'none');
        }
    }

    $("#name").click(function(){
        $("#color-select").css("display","block");
    })



    $("#color-select").hover(function(){
        $("#color-select").css('display','block');
    },function(){
        $("#color-select").css('display','none');
    });

    $("input[type='number']").blur(function(){
        var stock=$('#buy').attr('stock');

        if(this.value>6 && stock>6){
            this.value="6";
        }
        if(this.value<0){
            this.value="1";
        }

        if(this.value>stock && stock<6){
           this.value=stock;
        }
    });

    //
    $("#name").bind('DOMSubtreeModified',function(){
        $("input[name='count']").val("1");
    });

    //获取加入购物车的数据




    function getProductionData(){
        var formData=new FormData();
        var data=[];
        data['title1']=$("#title1").text();
        data['title2']=$("#title2").text();
        data['price']=$("#price").text();
        data['size']=$(".content p:first").text();
        data['img']=$("#main-img").attr("src");
        formData.append("title1",data['title1']);
        formData.append("title2",data['title2']);
        formData.append("price",data['price']);
        formData.append("size",data['size']);
        formData.append("img",data['img']);
        if($("#name").length!==0){
            data['colour_name']=$("#name span").eq(1).text();
            data['colour_num']=$("#name span:first").css("backgroundColor");
            data['colour_num']=toRGB(data['colour_num']);
            data['count']=$("input[name='count']").val();
            data['stock']=$("#buy").attr("stock");
            formData.append("colour_name",data['colour_name']);
            formData.append("colour_num",data['colour_num']);
            formData.append("count",data['count']);
            formData.append("stock",data['stock']);
        }

        return formData;
    }

    var shoppingHTML="";

    //加入购物车
    document.getElementsByName("addToCart")[0].onclick=function(){
        var Data;
        if(document.getElementById('name') && document.getElementById('name').getElementsByTagName('span')[1].innerText){
            Data=getProductionData();
        }else if(document.getElementById('name')===null){
            Data=getProductionData();
        }else{
            alert("请选择色号！");
        }

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                var result=JSON.parse(this.responseText);
                var shopping=document.getElementById('shopping');
                shoppingHTML=result['html'];
                console.log(shoppingHTML);
                shopping.innerHTML=result['html'];
                shopping.style.display="block";
            }
        };
        xhr.open("post","addCart.php",true);
        xhr.send(Data);

    };

    window.onload=function(){
        if(shoppingHTML!==""){
            document.getElementById('shopping').innerHTML=shoppingHTML;
        }
    }


    document.getElementsByName('buy')[0].onclick=function(){
        var Data;
        if(document.getElementById('name') && document.getElementById('name').getElementsByTagName('span')[1].innerText){
            Data=getProductionData();
        }else if(document.getElementById('name')===null){
            Data=getProductionData();
        }else{
            alert("请选择色号！");
        }

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                location.href="settleAccounts.php";
            }
        };
        xhr.open("post","toBuy.php",true);
        xhr.send(Data);
    }


    /*$(function(){

    })*/



</script>
</body>
</html>
