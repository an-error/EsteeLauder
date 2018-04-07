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
			background-color: rgba(230, 230, 230, 0.5);
			/* rgba(67,85,135,0.5) rgba(230,230,230,0.5)*/
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
		}
		
		.nav {
			width: 220px;
			height: 600px;
			position: absolute;
			left: 0;
			top: 120px;
			background-color: rgba(252, 252, 252, 1.00);
			border-radius: 8PX;
			padding:20px;
		}
		
		iframe{
			position:absolute;
			right:50px;
			top:120px;
			width:80%;
			background-color:rgba(252, 252, 252, 1.00);
			border-radius: 8px;
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
	</div>
	
	
	
	
	
	<div class="accordion nav" id="accordion2">

        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse"
                   data-parent="#accordion2" href="#">报表</a>
            </div>
           <!-- <div id="collapseZero" class="accordion-body collapse ">
                <div class="accordion-inner">
                    <a href="productionList.php" target="content">商品列表</a><br/>
                    <a href="productionOperation.php" target="content">商品添加</a>
                </div>
            </div>-->
        </div>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" 
				data-parent="#accordion2" href="#collapseOne">商品管理</a>
			</div>
			<div id="collapseOne" class="accordion-body collapse ">
				<div class="accordion-inner">
					<a href="productionList.php" target="content">商品列表</a><br/>
					<a href="addProduction.php" target="content">商品添加</a>
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
					<a href="managerOrder.php" target="content">订单列表</a><br/>
					<a href="#" target="content">订单添加</a>
				</div>
			</div>
		</div>
		
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" 
				data-parent="#accordion2" href="#collapseThree">用户管理</a>
			</div>
			<div id="collapseThree" class="accordion-body collapse ">
				<div class="accordion-inner">
					<a href="userList.php" target="content">用户列表</a><br/>
					<a href="#" target="content">用户添加</a>
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
					<a href="managerList.php" target="content">管理员列表</a><br/>
					<a href="addManager.php" target="content">管理员添加</a>
				</div>
			</div>
		</div>
	</div>
	
	<iframe id="content" name="content" frameborder="0" scrolling="auto"  height="700px"></iframe>
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
	</script>
	
</body>

</html>