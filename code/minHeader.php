<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/26
 * Time: 10:24
 */
include("module.php");
session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>

        header{
            background-color:hsla(0,0%,100%,.98);
			width:100%;
			height:80px;
            position:fixed;
            top:0;

            //font-family:STFangsong;
            font-weight: 600;
            z-index:150;
            box-shadow: 0 2px 4px 0 rgba(76,76,75,.1);
        }

		#logo{
			width:250px;
			height:70px;
            position:absolute;
            left:10px;

		}

        ul{
            list-style-type:none;
        }

        header nav  li{
            float:left;
        }

        header nav li a{
            display:block;
            width:100px;
            height:50px;
            line-height:50px;
            font-size:18px;
            color:black;
            text-decoration: none;
        }

        header  nav{
            position:absolute;
            top:30px;
            left:25%;
            font-family:STFangsong;
        }

        header nav li:nth-child(6) a{
            width:180px;
        }


        .dropdown-content li{

            float:left;
        }
        .dropdown-content ul li:nth-child(1){
            margin-left:700px;
        }

        .dropdown-content ul{
            display:block;

        }
        .dropdown-content{
            font-family:STFangsong;
            width:100%;
            height:300px;
            position:absolute;
            top:80px;
            background-color: rgba(255,255,255,0.9);
            text-align: center;
            padding:30px 10px;
            display:none;
            z-index:100;
        }

        .dropdown-content a{
            display:inline-block;
            text-decoration: none;
            color:black;
            width:70px;
            height:40px;
            line-height:40px;
            font-size:15px;

        }
        .dropdown-content img{
            position:absolute;
            width:448px;
            height:235px;
            left:10px;
            top:30px;
        }


        .dropdown-content li:hover a{
            color:grey;
        }



        .background{
            width:100%;
            height:100%;
            position:fixed;
            top:0;
            left:0;
            background-color:rgba(139,138,138,0.50);
            opacity: 50;
            display:none;
            z-index:180;
        }

        #login-pop{
            width:320px;
            height:350px;
            position:absolute;
            left:40%;
            top:25%;
            background-color:white;
        }

        .close-button{
            position:relative;
            left:-30px;
            top:10px;
        }

        .close-button:hover{
            color:darkred;
        }

        /*.close{
            height:30px;
            border-bottom: 1px solid grey;
        }*/

        #login-content{
            margin-top:50px;
            padding:30px;
        }

        #login-content i{
            font-size:25px;
            display:inline-block;
            margin-right:20px;
        }

        .login-bottom input{
            border:none;
            display:block;
            margin-left:37%;
            width:80px;
            height:30px;
            background-color: #265a88;
            color:white;
        }
        #password2,#phone,#email{
            display:none;
        }

        #login-content span{
            color:darkred;
            display:block;
            margin-left:60px;
        }

        #search{
            display:inline-block;
            width:180px;
            height:30px;
            border:none;
            border:1px solid grey;
            border-radius:10px;
            margin-right:10px;
            visibility:hidden;

        }

        #user-area i{
            font-size:30px;
            display:inline-block;
            margin-right:10px;
        }

        #user-area{
            position:absolute;
            top:20PX;
            right:30px;
        }

        #user-area span{
            font-size:30px;
            color:#CDC9A5;
            font-weight:100;
        }

        #userSelect{
            width:140px;
            height:135px;
            background-color:white;
            z-index:120;
            display:none;
            position:absolute;
            top:50px;
            right:10px;
            text-align: center;
        //border:1px solid grey;
            box-shadow: 0 0 5px grey;

        }

        .triangle-outer{
            width:0;
            height:0;
            border-style:solid;
            border-width: 10px;
            border-color: transparent transparent #dfe0e1 transparent;
            position:absolute;
            top:-20px;
            left:68px;
        }

        .triangle{
            width:0;
            height:0;
            border-style:solid;
            border-width: 10px;
            border-color: transparent transparent white transparent;
            position:absolute;
            top:-18px;
            left:68px;
        }

        #userSelect ul{
            padding:0;
        }
        #userSelect li {
            text-align: left;
            display: block;
            padding:10px;
            font-size:15px;
        //border-bottom:#737373 1px solid;
            font-weight: 300;
        }

        #userSelect i{
            font-size:18px;
        }



        #userSelect li:hover{
            background-color:#EDEDED;
        }

        #shopping{
            width:350px;
            height:700px;
            background-color:white;
            box-shadow: 0 0 10px grey;
            position:absolute;
            right:0;
            top:70px;
            padding:30px 10px 50px 10px;
            overflow-y:auto;
            display:none;
            z-index:150;

        }


        input[name='toCount']{

            width:200px;
            height:30px;
            background-color:black;
            color:white;
            border:none;
            margin:30px auto 40px 80px;
        }

        //别删了，有用
        .cart-area{
            width:320px;
            height:200px;
            //border-bottom: 1px solid grey;
            margin-bottom:20px;
        }

        .cart-area .row{
            width:320px
        }
        .cart-area .row img{
            width:100px;
            height:130px;
            float:left;
        }

        .cart-area p{
            font-size:10px;
        }

        .cart-area  input[type='number']{
            display:inline-block;
            margin-left:20px;
            height:20px;

        }

        /*#shopping .empty{
            position:absolute;
            top:35%;
            left:35%;
        }
*/
        .register-link{
            display:inline-block;
            margin:20px auto auto 45%;
        }

        .login-link{
            display:none;
            margin:20px auto auto 45%;
        }



    </style>
</head>

<body>
<header>
    <img src="../image/643e5703f4e6c6b3169cd4f2633d1e02（2）.jpg" id="logo"/>
    <div id="user-area">
        <input type="text" id="search"/>
        <i class="iconfont icon-Search" id="iconSearch"></i><span>|</span>
        <i class="iconfont user icon-user"  id="login" onclick="action(<?php echo $_SESSION['is_login']?>)"></i><span>|</span>
        <i class="iconfont icon-gift" id="cart" ></i>
        <div id="userSelect">
            <div class="triangle-outer"></div>
            <div class="triangle"></div>
            <ul>
                <!--<li><?php /*echo $_SESSION['user']*/?></li>-->
                <li><i class="iconfont icon-dingdan"></i><a href="user.php">订单详情</a></li>
                <li><i class="iconfont icon-gerenzhongxin"></i><a href="user.php">个人中心</a></li>
                <li onclick="exit();"><i class="iconfont icon-logout" ></i>退出</li>
            </ul>
        </div>
    </div>

    <div id="shopping" is_login="<?php echo $_SESSION['is_login']?>">
        <?php echo $_SESSION['html']?>
        <!--<div class="cart-area" stock="5">
            <div class="row">
                <div class="col-md-5">
                    <img src="../img/1.jpg"/>
                </div>
                <div class="col-md-7">
                    <p>Double Wear</p>
                    <p>雅诗兰黛持妆粉底液 SPF10/PA++</p>
                    <p>数量:<input type="number" min="1" max="6" value="1"/></p>
                    <p>价格：￥300</p>
                    <p class="pull-right"><i class="iconfont icon-changyonggoupiaorenshanchu"></i></p>
                </div>
            </div>
        </div>

        <p>总计：<span id="cart-total"></span></p>
        <input type="button" name="toCount" value="去结算" />-->
    </div>

    <nav>
        <ul >
            <li><a href="index.php">首页</a></li>
            <li class="dropdown" onmouseover="block()" onclick="load('face')"><a> 面部</a></li>
            <li class="dropdown" onmouseover="block()  " onclick="load('lips')"><a> 唇部</a></li>
            <li class="dropdown" onmouseover="block()" onclick="load('eyes')"><a>眼部</a></li>
           <li><a href="hot.php">明星产品</a></li>
            <li><a href="story.php">Estée Stories</a></li>
        </ul>
    </nav>
    <div class="dropdown-content" >
        <img src="../image/kendall_food.jpg"/>
        <ul>
            <li><a>粉底液</a></li>
            <li><a>粉饼</a></li>
            <li><a>气垫</a></li>
            <li><a>妆前乳</a></li>
            <li><a>腮红</a></li>
            <li><a>遮瑕膏</a></li>
        </ul>
        <br />
        <ul >
            <li><a>唇彩</a></li>
            <li><a>唇线笔</a></li>
            <li><a>唇膏</a></li>
            <li><a>唇釉</a></li>
        </ul>
        <br/>
        <ul>
            <li><a>眼影</a></li>
            <li><a>眼线笔</a></li>
            <li><a>睫毛膏</a></li>
            <li><a>眉笔</a></li>
        </ul>
        <br/>
    </div>
</header>

<div class="background">
<div id="login-pop">
    <div class="close">
        <div class="close-button"><i class="iconfont icon-guanbi"></i></div>
    </div>
    <div id="login-content">
        <form>
            <p id="user"><i class="iconfont user icon-user"></i><input type="text" name="user" placeholder="手机号码/邮箱"/> </p>
            <span class="user-login error"></span>
            <p id="phone"><i class="iconfont icon-phone"></i><input type="text" name="phone" placeholder="手机号码"/></p>
            <span class="phone error"></span>
            <p id="email"><i class="iconfont icon-185078emailmailstreamline"></i><input type="text" name="email" placeholder="邮箱"/> </p>
            <span class="email error"></span>
            <p><i class="iconfont icon-yypassword1"></i><input type="password" name="password" placeholder="密码"/> </p>
            <span class="password error"></span>
            <p id="password2"><i class="iconfont icon-yypassword1" ></i><input type="password" name="password2" placeholder="请再次输入密码"/> </p>
            <span class="password2 error"></span>
        </form>
    </div>
    <div class="login-bottom"><input type="button" name="submit" value="登录"/></div>
    <a href="#" class="register-link">注册</a>
    <a href="#" class="login-link">登录</a>
</div>
</div>

<script>
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

    //dropdown click
    $(".dropdown-content ul ").on("click","li a",function(){
        location.href="main.php?categories="+$(this).text();
    })


//退出
    function exit(){

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                location.href="index.php";
            }
        };
        xhr.open("get","exit.php",true);
        xhr.send();
    }

//二级菜单
    function block(){
        $('.dropdown-content').css("display","block");
    }


    $(".dropdown").hover(function(){
        $('.dropdown-content').hover(function(){
            $('.dropdown-content').css('display','block')
        },function(){
            $('.dropdown-content').css('display','none');
        });
    });


    function load(target){
        location.href="main.php?categories="+target;
    }

//login
    $('.close-button').click(function(){
        $('.background').css('display','none');
    });

//注册
    $(".register-link").click(function(){
        var formData=new FormData();
        toRegister();
        formData.append('register','true');
    });

    $(".login-link").click(function(){
        var formData=new FormData();
        //$(".register-link").css("display","none");
        toLogin();
        formData.append('login','true');
    });


    function clearError(){
        $("#login-content .error").each(function(){
            $(this).html("");
        })
    }
    function toRegister(){
        clearError();
        $("#login-content span").each(function(){
            $(this).css("display","none");
        });
        document.getElementsByClassName('register-link')[0].style.display="none";
        document.getElementsByClassName('login-link')[0].style.display="block";
        document.getElementById('user').style.display="none";
        document.getElementById('phone').style.display="block";
        document.getElementById('email').style.display="block";
        document.getElementById('password2').style.display="block";
        document.getElementById("login-pop").style.height="450px";
        document.getElementsByName('submit')[0].value="注册";
    }

    function toLogin(){
        clearError();
        $("#login-content span").each(function(){
            $(this).css("display","block");
        });
        document.getElementsByClassName('register-link')[0].style.display="block";
        document.getElementsByClassName('login-link')[0].style.display="none";
        document.getElementById('user').style.display="block";
        document.getElementById('phone').style.display="none";
        document.getElementById('email').style.display="none";
        document.getElementById('password2').style.display="none";
        document.getElementById("login-pop").style.height="350px";
        document.getElementsByName('submit')[0].value="登录";
    }

    //login or select
    function action(isLogin){
        if(isLogin){
            document.getElementById("userSelect").style.display="block";
        }else{
            document.getElementsByClassName('background')[0].style.display="block";
        }
    }

   /* $("#userSelect").hover(function(){
        $("#userSelect").css("display",block);
    },function(){
        $("#userSelect").css("display","none");
    })*/

   $("#userSelect ").mouseleave(function(){
       $("#userSelect").css("display","none");
   });

    $("#iconSearch").click(function(){
        $("#search").css("visibility","visible");
    });

    $("#search").mouseleave(function(){
        $("#search").css("visibility","hidden");
    });


    //登陆、注册
    document.getElementsByName("submit")[0].onclick=function(){

        var form=document.getElementsByTagName("form")[0];
        var formData=new FormData(form);
        if(document.getElementsByName('submit')[0].value==="登录"){
            formData.append("login","true");
        }
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                $("#login-content span").each(function(){
                    $(this).css("display","block");
                });
                var result=JSON.parse(this.responseText);
                if(result['error'].length!==0){
                    clearError();
                    if(result['error']['user']){
                        document.getElementsByClassName('user-login')[0].innerHTML=result['error']['user'];
                    }
                    if(result['error']['password']){
                        document.getElementsByClassName('password')[0].innerHTML=result['error']['password'];
                    }

                    if(result['error']['phone']){
                        document.getElementsByClassName('phone')[0].innerHTML=result['error']['phone'];
                    }

                    if(result['error']['email']){
                        document.getElementsByClassName('email')[0].innerHTML=result['error']['email'];
                    }

                    if(result['error']['password2']){
                        document.getElementsByClassName('password2')[0].innerText=result['error']['password2'];
                    }

                }

                if(result['success']){
                    alert(result['success']);

                    document.getElementsByClassName('background')[0].style.display="none";
                    location.reload();
                }

                if(result['register']){
                    toRegister();
                    formData.append('register','true');
                }

                if(result['fail']){
                    alert(result['fail']);
                    var background=document.getElementsByClassName('background')[0];
                    background.style.display="none";
                }
            }
        };
        xhr.open("post","userLoginCheck.php",true);
        xhr.send(formData);
    };

    //购物车
    $("#cart").click(function(){
        $("#shopping").css("display","block");
    });

    $("#shopping").on("blur","input[type='number']",function(){
        var stock=this.parentNode.parentNode.parentNode.parentNode.getAttribute('stock');
        if(this.value>6 && stock>6){
            this.value="6";
        }
        if(this.value<0){
            this.value="1";
        }

        if(this.value>stock && stock<6){
            this.value=stock;
        }
    })

    $("#shopping").mouseleave(function(){
        $("#shopping").css("display","none");
    });



    /*$("#shopping").bind('DOMNodeInserted',function(){
        var total=0;
        for(var i=0;i<$(".cart-area").length;i++){
            var price=$(".cart-area").eq(i).find('.cart-price:first').text().substr(4);
            var count=$(".cart-area").eq(i).find('.cart-count:first').val();
            total+=price*count;
        }
        $("#cart-total").text(total);
    });*/





    $("#shopping").on("click",".cart-area i",function(e){
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
                document.getElementById('cart-total').innerText=result['total'];
                document.getElementById('shopping').innerHTML=result['html'];
            }
        };
        xhr.open("post","delSession.php",true);
        xhr.send(data);


    })

    /*$("#shopping").on("change",".cart-total",function(){
        var total=0;
        var arr=[];
        $(".cart-area").each(function(){
            if(this.css("display")==="block"){
                arr[]=this;
            }
        });
        for(var i=0;i<arr.length;i++){
            var price=arr[i].find('.cart-price:first').text().substr(4);
            var count=arr[i].find('.cart-count:first').val();
            total+=price*count;
        }
        $("#cart-total").text(total);
    })
*/

    /*document.getElementById("shopping").on("change",".cart-total",function(){
        alert(0);
    });*/

    $("#shopping").on("change",".cart-area",function(e){
        var node=e.target;
        var parent=node.parentNode.parentNode.parentNode.parentNode;

        var data=new FormData();
        data.append('sku',parent.getAttribute('sku'));
        data.append("count",node.value);

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                document.getElementById('cart-total').innerText=this.responseText;
            }
        };
        xhr.open("post","countChange.php",true);
        xhr.send(data);
    })


    /*$("#shopping").on('click','input[name="toCount"]',function(){
        location.href="settleAccounts.php";
    })
*/

    function toCount(){
        var is_login=$("#shopping").attr('is_login');
        if(is_login){
            location.href="settleAccounts.php";
        }else{
            document.getElementsByClassName("background")[0].style.display="block";
        }
    }

    document.getElementById("search").onkeydown=function(){
        console.log(this.value);
        if(event.keyCode=='13'){
            if(this.value) {
                location.href="search2.php?search="+this.value;
            }
        }
    }


</script>
</body>
</html>
