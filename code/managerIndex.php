<?php include("module.php")?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
	<link href="../module/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../module/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="../module/jquery.js" type="text/javascript"></script>
	<script src="../module/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		
		body {
			background-color:rgba(230,230,230,0.5);
			/* rgba(67,85,135,0.5) rgba(230,230,230,0.5) #2c343c*/
            font-family: FangSong   ;
		}
		
		#logo {
			width: 220px;
			height: 80px;
			display: block;
			float: left;
			box-shadow: 5px 5px 10px rgb(67, 85, 135);
			z-index: 100;
		}
		
		#header {
			width: 100%;
			height: 80px;
			background-color: white;
		}
		
		#search {
			position: absolute;
			width: 280px;
			height: 40px;
			right: 50px;
			top: 20px;
		}
		
		input[name="search"] {
			display: block;
			height: 40px;
			width: 280px;
			position: relative;
			border-radius: 15px;
			box-shadow: 1px 1px 2px rgb(67, 85, 135);
			border: 1px solid rgba(207, 207, 207, 1.00);
			text-align: center;
			margin-right: -10px;
		}
		
		.search {
			display: block;
			position: absolute;
			left: 8px;
			top: 5px;
			font-size: 27px;
			z-index: 100;
			color: rgba(214, 214, 214, 1.00);
		}
		
		#name {
			position: absolute;
			top: 60px;
			left: 280px;
            font-family: FZShuTi ;
		}

        #accordion2 {
            width:100%;
            height:700px;
            padding:0 0 0 220px;
            margin-top:20px;
            box-sizing: border-box;
        }
		.nav {
			width: 220px;
			height: 100%;
            margin:0 0 0 -200px;
			/*position: absolute;
			left: 0;
			top: 120px;*/
			background-color: rgba(252, 252, 252, 1.00);
			padding:20px;
		}
		
		iframe{
			position:absolute;
			right:50px;
			top:100px;
			width:83%;
			background-color:rgba(252, 252, 252, 1.00);
			border-radius: 10px;
		}
		
		.accordion-heading a{
			display:block;
			margin:10px;
			width:100%;
			font-size:17px;
		}
		.accordion-body a{
			display:block;
			padding-left:60px;
		}

        .icon-logout{
            font-size:30px;
            position:absolute;
            right:5px;
            top:20px;
        }

        #collapsetwo .accordion-inner ul{
            list-style-type: none;
        }

        #collapsetwo .accordion-inner ul li{
            height:40px;
            line-height: 40px;
        }
	</style>
</head>

<body >

	<img id="logo" src="../image/643e5703f4e6c6b3169cd4f2633d1e02.jpg">
	<div id="header">
		<div id="name">
			<?php 
			session_start();
			echo "欢迎回来，".$_SESSION['name'];
	?>
		</div>
		<div id="search">
			<i class="fa fa-search search" aria-hidden="true"></i>
			<input name="search" type="text"/>
		</div>

        <i class="iconfont icon-logout"></i>
	</div>
	
	
	
	
	
	<div class="accordion nav" id="accordion2">

        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse"
                   data-parent="#accordion2" href="#collapseZero">报表</a>
            </div>
            <div id="collapseZero" class="accordion-body collapse ">
                <div class="accordion-inner">
                    <a href="report.php" target="frame-content">报表</a><br/>
                </div>
            </div>
        </div>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" 
				data-parent="#accordion2" href="#collapseOne">商品管理</a>
			</div>
			<div id="collapseOne" class="accordion-body collapse ">
				<div class="accordion-inner">
					<a href="productionList.php" target="frame-content">商品列表</a><br/>
					<a href="addProduction.php" target="frame-content">商品添加</a>
				</div>
			</div>
		</div>
		
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" 
				data-parent="#accordion2" href="#collapsetwo">订单管理</a>
			</div>
			<div id="collapsetwo" class="accordion-body collapse ">
				<div class="accordion-inner">
                    <ul>
					<li><a href="managerOrder.php" target="frame-content">订单列表</a></li>
					<li><a href="managerOrderSearch.php?status=0" target="frame-content">待付款</a></li>
                        <li><a href="managerOrderSearch.php?status=1" target="frame-content">待发货</a></li>
                        <li><a href="managerOrderSearch.php?status=4" target="frame-content">待签收</a></li>
                        <li><a href="managerOrderSearch.php?status=2" target="frame-content">已签收</a></li>
                        <li><a href="managerOrderSearch.php?status=3" target="frame-content">已评论</a></li>
                        <li><a href="managerOrderSearch.php?status=5" target="frame-content">交易失败</a></li>
                    </ul>
				</div>
			</div>
		</div>
		

		
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" 
				data-parent="#accordion2" href="#collapsefFour">管理员管理</a>
			</div>
			<div id="collapsefFour" class="accordion-body collapse ">
				<div class="accordion-inner">
					<a href="managerList.php" target="frame-content">管理员列表</a><br/>
					<a href="addManager.php" target="frame-content">管理员添加</a>
				</div>
			</div>
		</div>

        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse"
                   data-parent="#accordion2" href="#collapsefFive">评论管理</a>
            </div>
            <div id="collapsefFive" class="accordion-body collapse ">
                <div class="accordion-inner">
                    <a href="managerComment.php" target="frame-content">管理评论</a><br/>
                </div>
            </div>
        </div>

        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse"
                   data-parent="#accordion2" href="#collapsefSix">退货管理</a>
            </div>
            <div id="collapsefSix" class="accordion-body collapse ">
                <div class="accordion-inner">
                    <a href="managerReturnGoods.php" target="frame-content">管理退货</a><br/>
                </div>
            </div>
        </div>


	</div>
	
	<iframe id="frame-content" name="frame-content" frameborder="0" scrolling="auto"  height="700px"></iframe>
	<script>
		$( function () {
			$( '#myTab a:last' ).tab( 'show' );
		} );
		
		$('.dropdown-toggle').click(function(){
			$('.dropdown-menu').css("display","block");
		});
		
		$('#collapseOne').on('hide',function(){
			$(this).css("display","none");
		});

        $(".icon-logout").click(function(){
            var isExit=confirm("是否退出？");
            if(isExit){
                location.href="managerLogin.php";
            }

        })

        document.getElementsByName("search")[0].onkeydown=function(){
            if(event.keyCode=='13'){
                if(this.value) {

                    var frame=document.getElementById("frame-content");
                    frame.src="search.php?search="+this.value;
                }
            }
        };



	</script>
	
</body>

</html>