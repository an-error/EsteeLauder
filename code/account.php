<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/4
 * Time: 10:24
 */
include("minHeader.php");
include("conn.php");
session_start();
$addressID=$_SESSION['addressID'];
$statement=$db->prepare("select * from address where id=:id");
$statement->bindParam(":id",$addressID,PDO::PARAM_STR);
$statement->execute();
$address=$statement->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        .address{
            width:700px;
            height:150px;
            margin:160px auto 100px 420px;
            border:1px dashed #dfe0e1;
            padding:20px;
            font-size:16px;

        }

        .address span{
            display:inline-block;
            width:100px;
            height:30px;
            line-height: 30px;
            text-align: right;
            margin-right:20px;
        }

        #shopping-cart{
            width:700px;
            height:auto;
            margin-left:400px;
            /*position:absolute;
            top:20%;
            left:18%;*/
            margin-bottom: 100px;
        }

        .cart-block img{
            width:150px;
            height:180px;
        }

        .cart-block{
            margin:40px;
            padding-bottom:40px;
            border-bottom: 1px solid #dfe0e1;
        }

        .cart-block .row span{
            display:inline-block;
            width:20px;
            height:20px;
            margin-right:30px;
        }

        #account{
            width:700px;
            margin:150px auto 200px 420px;
        }

        #account p{
            font-size:20px;
        }

        #account div{
            margin:50px auto 50px 450px;
        }

        #account input{
            width:50px;
            height:30px;
            border:none;
            color:white;
            margin-right:20px;
        }

        #account input[name="toAccount"]{
            width:120px;
            height:30px;
            background-color: #265a88;
        }

        #account input[name="backToAddress"]:hover{
            background-color: #265a88;
        }

        .account-text{
            margin-left:430px;
        }

        .account-text textarea{
            width:500px;
            height:100px;
        }
    </style>
</head>

<body>

    <div class="address">
        <div class="address-area" >
            <p><span>收件人：</span><?php echo $address['name']?></p>
            <p><span>手机号码：</span><?php echo $address['phone']?></p>
            <p><span>地址：</span><?php echo $address['address']?></p>
        </div>
    </div>

    <div id="shopping-cart">
        <?php if(empty($_SESSION['buy'])):?>
        <?php foreach($_SESSION['cart'] as $cart):?>
            <div class="cart-block" stock="<?php echo $cart['stock']?>">
                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo $cart['img']?>"/>
                    </div>
                    <div class="col-md-7">
                        <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                        <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                        <p>数量：<?php echo $cart['count']?></p>
                        <p class="pull-right">价格：<?php echo $cart['price']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        <?php endif;?>
        <?php if(!empty($_SESSION['buy'])):?>
        <?php foreach($_SESSION['buy'] as $cart):?>
            <div class="cart-block" stock="<?php echo $cart['stock']?>">
                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo $cart['img']?>"/>
                    </div>
                    <div class="col-md-7">
                        <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                        <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                        <p>数量：<?php echo $cart['count']?></p>
                        <p class="pull-right">价格：<?php echo $cart['price']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>

    <div class="account-text">备注：<textarea></textarea></div>

    <div id="account">
        <p>总计：  ￥<?php if(empty($_SESSION['buy'])){echo $_SESSION['total'];}else{echo $_SESSION['buyTotal'];}?></p>
        <div>
        <input type="button" value="返回" name="backToAddress" onclick="location.href='index.php'" />
        <input type="button" value="支付" name="toAccount" />
        </div>
    </div>




<script>
    document.getElementsByName("toAccount")[0].onclick=function(){
        var isPay=confirm("是否支付？");
        var data=new FormData();
        data.append("isPay",isPay);
        var text=document.getElementsByTagName("textarea")[0].value;
        data.append('text',text);
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                document.getElementById("shopping").innerHTML="";
                location="order.php"
            }
        };
        xhr.open("post","addOrder.php",true);
        xhr.send(data);
    }

    $("#cart").click(function(){
        $("#shopping").css("display","none");
    })
</script>
</body>
</html>
