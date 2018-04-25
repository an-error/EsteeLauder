<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/1
 * Time: 14:07
 */

include("minHeader.php");
session_start();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>


        #shopping-cart{
            width:700px;
            height:auto;
            position:absolute;
            top:20%;
            left:18%;
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

        #continueShopping,#backToUser{
            display:block;
            width:700px;
            height:auto;
            position:absolute;
            top:17%;
            left:18%;
            border-bottom: 1px solid #dfe0e1;
        }

        #account{
            position:fixed;
            top:200px;
            right:100px;
        }

        #account div{
            border:1px solid #dfe0e1;
            margin-bottom: 20px;
        }

        #account p ,#account input{
            display:block;
            width:200px;
            height:30px;
            line-height: 30px;
        }

        #account p:nth-child(1){
            text-align: center;
            border-bottom:1px solid #dfe0e1 ;
            line-height: 30px;
        }

        #account p:nth-child(2){
            padding-left:20px;
        }

        #account input{
            background-color: #265a88;
            color:white;
            border:none;
        }

    </style>


</head>

<body>

<?php if($_REQUEST['back']):?>
    <p id="backToUser"><a href="user.php">返回</a></p>

<?php else:?>
    <p id="continueShopping"><a href="index.php">继续购物</a></p>
<?php endif;?>
<div id="shopping-cart">
    <?php if(empty($_SESSION['buy'])):?>
    <?php if(!empty($_SESSION['cart'])):?>
    <?php foreach($_SESSION['cart'] as $key=>$cart):?>
        <div class="cart-block" stock="<?php echo $cart['stock']?>" sku="<?php echo $key?>">
           <div class="row">
               <div class="col-md-5">
                   <img src="<?php echo $cart['img']?>"/>
               </div>
               <div class="col-md-7">
                   <p class="pull-right"><i class="iconfont icon-changyonggoupiaorenshanchu del"></i></p>
                   <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                   <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                   <p>数量:<input type="number" min="1" max="6" value="<?php echo $cart['count']?>"/></p>
                   <p class="pull-right">价格：<?php echo $cart['price']?></p>
               </div>
           </div>
       </div>
    <?php endforeach;?>
    <?php endif;?>
    <?php endif;?>

    <?php if(!empty($_SESSION['buy'])):?>
    <?php foreach($_SESSION['buy'] as $key=>$cart):?>
        <div class="cart-block" stock="<?php echo $cart['stock']?>" sku="<?php echo $key?>">
            <div class="row">
                <div class="col-md-5">
                    <img src="<?php echo $cart['img']?>"/>
                </div>
                <div class="col-md-7">
                    <p class="pull-right"><i class="iconfont icon-changyonggoupiaorenshanchu del"></i></p>
                    <p><?php echo $cart['title1']?> <?php echo $cart['title2']?></p>
                    <p><span style="background-color: <?php echo $cart['colour_num']?>"></span><?php echo $cart['colour_name']?></p><!--色号-->
                    <p>数量:<input type="number" min="1" max="6" value="<?php echo $cart['count']?>"/></p>
                    <p class="pull-right">价格：<?php echo $cart['price']?></p>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    <?php endif;?>



</div>

<div id="account">
    <div>
    <p>账单</p>
    <p>总计：￥<span id="total"><?php if(empty($_SESSION['buy'])){echo $_SESSION['total'];}else{echo $_SESSION['buyTotal'];}?></span></p>
    </div>
    <input type="button" name="continue" value="继续结账" onclick="toContinue(<?php echo $_SESSION['is_login']?>)"/>
</div>
<?php include("footer.php")?>
<script>

    $("footer").css("position","absolute");
   /* $("input[name='continue']").click(function(){

        location.href="address.php";
    })*/

    function toContinue(isLogin){
        if(isLogin){
            location.href="address.php";
        }else{
            document.getElementsByClassName('background')[0].style.display="block";
        }
    }

    $(".del").click(function(e){
        {
            var node=e.target;
            var parent=node.parentNode.parentNode.parentNode.parentNode;
            var sku=parent.getAttribute('sku');
            //console.log(sku);
            //location.href="delSession.php?id='"+sku+"'";
            var data=new FormData();
            data.append('id',sku);
            var xhr=new XMLHttpRequest();
            //var url="delSession.php?id='"+sku+"'";

            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                    parent.style.display="none";
                    var result=JSON.parse(this.responseText);
                    document.getElementById('total').innerText=result['total'];
                    if(result['total']===0){
                        document.getElementById('account').style.display="none";
                    }

                }
            };
            xhr.open("post","delSession.php",true);
            xhr.send(data);


        }
    });

    $("#shopping-cart").on("change",".cart-block",function(e){
        var node=e.target;
        var parent=node.parentNode.parentNode.parentNode.parentNode;

        var data=new FormData();
        data.append('sku',parent.getAttribute('sku'));
        data.append("count",node.value);

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                var result=JSON.parse(this.responseText);
                document.getElementById('total').innerText=result['total'];
                node.value=result['count'];
            }
        };
        xhr.open("post","countChange.php",true);
        xhr.send(data);
    });

    $("#cart").click(function(){
        $("#shopping").css("display","none");
    })
</script>

</body>
</html>
