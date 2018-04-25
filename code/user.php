<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/5
 * Time: 22:18
 */
include("conn.php");
include("minHeader.php");

session_start();
$uid=$_SESSION['id'];

$sql="select * from user where id='".$uid."'";
$statement=$db->query($sql);
$user=$statement->fetch(PDO::FETCH_ASSOC);


$sql="select * from esteelauder.order where status='待付款' and uid='".$uid."'";
$statement=$db->query($sql);
$noPay=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='待发货' and uid='".$uid."'";
$statement=$db->query($sql);
$noManager=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='已签收' and uid='".$uid."'";
$statement=$db->query($sql);
$noComment=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='已发货' and uid='".$uid."'";
$statement=$db->query($sql);
$noReceive=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));

$sql="select * from esteelauder.order where status='交易失败' and uid='".$uid."'";
$statement=$db->query($sql);
$fail=sizeof($statement->fetchAll(PDO::FETCH_ASSOC));


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        #anchor ul{
            list-style-type: none;
            width:200px;
            height:250px;
            position:fixed;
            top:280px;
            left:6%;
        }

        #anchor li {
            line-height: 35px;
            font-size:16px;
        }

        #content{
            width:1100px;
            margin:150px auto 70px 22%;
        }

        #order li{
            display:inline-block;
            width:160px;
            text-align: center;
            border-right:1px solid #f5f8fa;
            //margin-right:100px;
        }

        #order li:nth-child(4){
            border-right:none;
        }
        #order .user-name{

            height:70px;
            background-color: #f5f8fa;
            line-height: 60px;
            padding:10px;
        }

        #order .user-name i{
            font-size:30px;
        }

        #order .user-name span{
            margin-left:10px;
        }

        #order .nav{
            border:1px solid #f5f8fa;
            padding:20px;
            margin-bottom:100px;
        }

        //别删
        .order-content{
            width:1000px;
            height:auto;
            margin:200px auto 100px auto;
              //padding:30px;
            border:1px solid #dfe0e1;
        }


        .order-content img{
            width:100px;
            height:120px;
        }

        .order-content table span{
            display:inline-block;
            width:20px;
            height:20px;
            margin-right:20px;
        }

        .order-content table td{
            text-align: center;
            border-bottom:1px solid #dfe0e1 ;
            padding:20px;
        }
        .order-content table thead td{
            height:40px;
        }

        .order-content .right{
            font-size:18px;
            display: block;
            margin:40px auto 50px 570px;
        }


        .order-content h4{
            margin-bottom:30px;
        }

        .order-tip{
            color:red;
            margin-left:15px;
        }

        .order-content input{
            width:100px;
            height:30px;
            color:white;
            background-color: #265a88;
            border:none;
            margin-left:50px;
        }

        #userInformation{
            width:600px;
            height:500px;
           border:1px solid #dfe0e1 ;
            display:none;
            margin-left:250px;
            padding:50px;
            line-height: 30px;
            font-size:18px;
        }

        #userInformation span{
            display:inline-block;
            width:150px;
            text-align:right;
            margin-right:30px;
        }

        #userInformation p{
            margin-bottom:20px;
        }

        #userInformation input[name='revise']{
            width:100px;
            height:30px;
            border:none;
            background-color: #265a88;
            color:white;
            margin:100px auto  auto  230px;
        }


        #userInformation .password2{
            display:none;
        }

        #userInformation i{
            font-size: 12px;
            color:red;
        }

        .basic{
            width:1000px;
            height:40px;
            background:#dfe0e1;
            padding-left:30px;
        }

        .basic span{
            margin-right:30px;
            line-height:40px;
        }

        .addCss{
            width:1000px;
            height:auto;
            margin:200px auto 100px auto;
            border:1px solid #dfe0e1;
        }
        .padding{

            padding:30px;
        }

        .fake-comment{
            position:relative;
        }

        .fake-comment input[name="comment"]{
            opacity: 0;
            z-index:7;
        }
        .fake-comment .icon-pingjia{
            font-size:40px;
            color:grey;
            position:absolute;
            left:140px;
            top:-10px;
        }


    </style>
</head>

<body>
    <nav id="anchor">
        <ul>
            <li class="displayOrder"><a href="#order">订单信息</a></li>
            <li><a href="settleAccounts.php?back=1">我的购物车</a></li>
            <li class="displayToBlock"><a >个人信息管理</a></li>
            <li><a href="address.php?just=1">收件人管理</a></li>
        </ul>
    </nav>

    <div id="content">
        <div id="order">
            <div class="user-name"><i class="iconfont icon-gerenzhongxin"></i><span><?php if($user['name']){echo $user['name'];}else{echo $user['phone'];}?></span></div>
            <div class="nav">
                <nav>
                    <ul>
                        <li ><a>已完成</a></li>
                        <li ><a>退款</a></li>
                        <li ><a>待付款</a><span class="order-tip"><?php if($noPay!=0){echo $noPay;}?></span></li>
                        <li><a>待发货</a><span class="order-tip"><?php if($noManager!=0){echo $noManager;}?></span></li>
                        <li><a>待收货</a><span class="order-tip"><?php if($noReceive!=0){echo $noReceive;}?></span></li>
                        <li ><a>待评价</a><span class="order-tip" id="comment"><?php if($noComment!=0){echo $noComment;}?></span></li>
                    </ul>

                </nav>
            </div>
                <div class="show">

                </div>
        </div>

       <div id="userInformation">

           <form ID="<?php echo $user['id']?>">
               <p><span>昵称：</span><input name="name" type="text" placeholder="<?php echo $user['name']?>" /> </p>
               <p><span>手机号码：</span><input name="phone" type="text" placeholder="<?php echo $user['phone']?>" /><i></i></p>
               <p><span>邮箱：</span><input name="email" type="text" placeholder="<?php echo $user['email']?>" /><i></i></p>
               <p><span>密码：</span><input name="password" type="text" placeholder="<?php echo $user['password']?>" /><i></i></p>
               <p class="password2"><span>再次输入密码：</span><input name="password2" type="text" " /><i></i></p>
               <p><input type="button" value="修改" name="revise"/></p>
           </form>
       </div>




    </div>

<script>
    $("#order .nav").on("click","li",function(e){
        var map=[];
        map['已完成']="已评价";
        map['待评价']="已签收";
        map['待发货']="待发货";
        map['待收货']="已发货";
        map['待付款']="待付款";
        map['退款']="交易失败";

        var data=new FormData();
        data.append("status",map[e.target.innerText]);

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                document.getElementsByClassName('show')[0].innerHTML=this.responseText;
            }
        };
        xhr.open("post","showOrder.php",true);
        xhr.send(data);
    });

    $(".show").on("click",".order-content input[name='rePay']",function(){
        var pay=confirm("是否支付？");
        if(pay){
            var data=new FormData();
            data.append("option",'待发货');
            var temp=this.parentNode.parentNode.getElementsByTagName('h4')[0].innerText;
            var orderID=temp.split("：")[1];
            data.append('orderID',orderID);
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                    location.href="order.php?id="+orderID;
                }
            };
            xhr.open("post","updateStatus.php",true);
            xhr.send(data);
        }

    })

    $(".show").on("click",".order-content input[name='confirm']",function(){
        var temp=confirm("是否确认收货？");
        if(temp){
            var data=new FormData();
            data.append("option",'已签收');
            var temp=this.parentNode.parentNode.getElementsByTagName('h4')[0].innerText;
            var orderID=temp.split("：")[1];
            data.append('orderID',orderID);
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                   //document.getElementsByClassName('order-tip')[3].click();
                    //$("#comment").trigger("click");
                    //location.href="comment.php?orderID="+orderID+"&"
                    location.reload();
                }
            };
            xhr.open("post","updateStatus.php",true);
            xhr.send(data);
        }
    });

    $(".show").on("click",".order-content input[name='comment']",function(){
        var parent=this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
        var temp=parent.getElementsByClassName("orderID")[0].innerText;
        var sku=parent.getAttribute('sku');
        var orderID=temp.split("：")[1];
        sku=sku.replace(/\#/g,"%23");
        sku=sku.replace(/\+/g,"%2B");
        location.href="comment.php?orderID="+orderID+"&sku="+sku;
    });

    $(".show").on("click",".order-content input[name='return']",function(){
        console.log(this);
        var parent=this.parentNode;
        var temp=parent.getElementsByTagName("h4")[0].innerText;
        var orderID=temp.split("：")[1];
        location.href="return.php?orderID="+orderID;
    });



    $(".displayToBlock").click(function(){
        $("#order").css("display","none");
        $("#userInformation").css("display","block");
    });

    $(".displayOrder").click(function(){
        $("#userInformation").css("display","none");
        $("#order").css("display","block");

    });

    $("#userInformation input[name='password']").focus(function(){
        $("#userInformation .password2").css("display","block");
    });




    document.getElementsByName("revise")[0].onclick=function(){
        var form=document.getElementById('userInformation').getElementsByTagName('form')[0];
        var formData=new FormData(form);
        var id=form.getAttribute('ID');
        formData.append('id',id);
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                var result=JSON.parse(this.responseText);
                var i=document.getElementById('userInformation').getElementsByTagName('i');
                if(result['error']){
                    var error=result['error'];
                    if(error['phone']){
                        i[0].innerText=error['phone'];
                    }
                    if(error['email']){
                        i[1].innerText=error['email'];
                    }
                    if(error['password']){
                        i[2].innerText=error['password'];
                    }
                    if(error['password2']){
                        i[3].innerText=error['password2'];
                    }
                }
                if(result['success']){
                    location.reload();
                }
            }
        };
        xhr.open("post","userInformationCheck.php",true);
        xhr.send(formData);

    }




</script>

</body>
</html>
