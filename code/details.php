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

$sql="select * from comment where pid='".$_REQUEST['id']."' and isShow=1";
$statement=$db->query($sql);
$comment=$statement->fetchAll(PDO::FETCH_ASSOC);
$commentCount=sizeof($comment);
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



        /*#background{
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
        }*/
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

        #lack{
            display:none;
            color: #EE2C2C;
            margin:20px auto;
        }

        #detail{
            width:70%;
            margin:150px auto;
            padding:40px;
        }

        #detail textarea{
            width:60%;
            height:500px;
            font-size: 16px;
            border:none;
        }

        a[href="#detail"]{
            display:inline-block;
            margin-right:20px;
        }

        #comment{
            width:70%;
            margin:150px auto;
            padding:40px;
        }

        #comment{
            width:70%;
            margin:150px auto;
            padding:30px;
        }

        .comment-content{
            padding-bottom::30px;
            border-bottom: 1px solid #dfe0e1;
        }

        .comment-content-text{
            width:500px;
            height:120px;
        //background-color: #265a88;
            float:left;
            margin-right:150px;
            padding:30px;
        }

        .comment-content-stars ul{
            display:block;
            list-style-type: none;
            height:30px;
            width:400px;
            line-height:30px;
        }

        .comment-content-stars li{
            float:left;
        }



        .comment-content-stars li:nth-child(1){
            display: inline-block;
            margin-right:30px;
        }

        .comment-content-stars .icon-xingxing{
            font-size:20px;
            color:grey;
        }

        .comment-content-stars .icon-icon-test{
            font-size:20px;
            color:gold;
        }
        .comment-content-stars{
            display:inline-block;
            padding:20px;
            width:400px;
            height:200px;

        }
        .comment-content p{
            width:200px;
        }

        .comment-content-img{
            width:700px;
            height:150px;
            padding:20px;
            position:relative;
        }

        .comment-content-img img{
            width:80px;
            height:100px;
            margin-right:20px;
            float:left;
        }

        .comment-content-big-img{
            position:absolute;
            top:130px;
            z-index:3;
            display:none;
        }

        .comment-content-big-img img{
            width:300px;
            height:400px;

        }

        .my-icon{
            width:40px;
            height:40px;
            background-color:#F5F5F5;
            margin:50px 20px;
            position: fixed;
            text-align: center;
            line-height: 40px;
            top:480px;
        }

        .my-icon div{
            width:0;
            height:0;
            border-style:solid;
            border-width: 20px;
            border-color:transparent #F5F5F5 transparent transparent;
            position:absolute;
            left:-40px;

        }

        .detail-icon{
            top:530px;
        }

        .comment-icon{
            top:580px;
        }

        .my-icon a[href='#detail']{
            display:inline-block;
            width:40px;
        }


    </style>
</head>

<body>
<div class="my-icon" onclick="history.back();"><div></div><a>返回</a></div>
<div class="my-icon detail-icon"><div></div><a href="#detail">详情</a></div>
<div class="my-icon comment-icon"><div></div><a href="#comment">评论</a></div>

<div id="fence"><?php /*echo $major['major']*/?><!-- &gt --><?php /*echo $result['categories']*/?></div>
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
            <div style="margin-top:<?php if($color[0]['colour_num']==='#ffffff'){ echo '120px';}?>"><a href="#detail">商品详情</a><a href="#comment">评价</a></div>
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



            <p id="lack" >暂时缺货</p>

        </div>
    </div>

    <!--购物车-->
    <div id="shoppingCart">

    </div>

</div>
<!--商品详情-->
<!--<div id="background">
    <div id="pop">
        <div id="close">
            <button id="close-button">X</button>
        </div>
        <div class="pop-content">
            <?php /*echo $result['text']*/?>
        </div>
    </div>
</div>-->

<fieldset id="detail">
    <legend>商品详情</legend>
    <textarea><?php echo $result['text']?></textarea>
</fieldset>

<!--评价-->
<fieldset id="comment">
    <legend>评价（共<?php echo $commentCount?>条）</legend>
    <?php foreach($comment as $r):?>
        <div class="comment-content">
            <div class="comment-content-text"><?php echo $r['content']?></div>
            <div class="comment-content-stars">
                <ul class="one">
                    <li>宝贝与描述相符</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$r['goodsScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
                <ul class="two" >
                    <li>我们的服务态度</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$r['serviceScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
                <ul class="three">
                    <li>物流的服务质量</li>
                    <?php for($i=0; $i<5;$i++):?>
                        <?php if($i<$r['timeScore']):?>
                            <li><i class="iconfont icon-icon-test" ></i></li>
                        <?php else:?>
                            <li><i class="iconfont icon-xingxing" ></i></li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>

            <?php if($r['img0']!=''):?>
                <div class="comment-content-img">
                    <img src="<?php echo $r['img0']?>" />
                    <img src="<?php echo $r['img1']?>" />
                    <img src="<?php echo $r['img2']?>" />
                    <img src="<?php echo $r['img3']?>" />
                    <img src="<?php echo $r['img4']?>" />
                    <div class="comment-content-big-img"></div>
                </div>
            <?php endif;?>
            <p><span><?php echo $r['create_at']?></span></p>
        </div>
    <?php endforeach;?>

</fieldset>
<?php include("footer.php")?>
<script src="setRGB.js"></script>
<script>


   /* $("#detail").click(function(){
        $("#background").css("display","block");
    });

    $("#close-button").click(function(){
        $("#background").css("display","none");
    });
*/

   //textarea高度根据内容变换
   var textarea=document.getElementsByTagName("textarea")[0];
   textarea.style.height=textarea.scrollHeight+'px';


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
    });



    $("#color-select").hover(function(){
        $("#color-select").css('display','block');
    },function(){
        $("#color-select").css('display','none');
    });



    $("input[type='number']").change(function(){
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
    };


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
    };


    $(function(){
        $("img").each(function(){
            if($(this).attr('src')===""){
                $(this).css("display","none");
            }
        })
    })

    $(".comment-content-img").on("click","img",function(){
        $(".comment-content-big-img").each(function(){
            $(this).css("display","none");
        });
        var path=$(this).attr("src");
        var temp="<img src='"+path+"'/>";
        $(this.parentNode).find('.comment-content-big-img').html(temp);
        $(this.parentNode).find('.comment-content-big-img').css("display","block");
    });

    $(".comment-content-big-img").mouseleave(function(){
        $(this).css("display","none");
    })





</script>
</body>
</html>
