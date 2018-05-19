<?php include("module.php");
session_start();
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
	<link href="../module/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../module/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="../module/jquery.js" type="text/javascript"></script>
	<script src="../module/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <link href="../style/managerIndex.css" rel="stylesheet"/>
</head>

<body >

	<img id="logo" src="../image/152543745182553.jpg"  />
	<div id="header">
		<div id="name">
			<?php echo "欢迎回来，".$_SESSION['name'];
	?>
		</div>
		<div id="search">
			<i class="fa fa-search search" aria-hidden="true"></i>
			<input name="search" type="text"/>
		</div>

        <i class="iconfont icon-logout"></i>
	</div>
	
	

    <div id="nav">
        <nav>
            <ul>
                <li><span><a href="report.php" target="frame-content">报表</a></span></li>
                <li><span>商品管理</span>
                    <ul class="secondary">
                        <li><span><a href="productionList.php" target="frame-content">商品列表</a></span></li>
                        <li><span><a href="addProduction.php" target="frame-content">商品添加</a></span></li>
                    </ul>
                </li>
                <li><span>订单管理</span>
                    <ul class="secondary">
                        <li><span><a href="managerOrder.php" target="frame-content">订单列表</a></span></li>
                        <li><span><a href="managerOrderSearch.php?status=0" target="frame-content">待付款</a></span></li>
                        <li><span><a href="managerOrderSearch.php?status=1" target="frame-content">待发货</a></span></li>
                        <li><span><a href="managerOrderSearch.php?status=4" target="frame-content">待签收</a></span></li>
                        <li><span><a href="managerOrderSearch.php?status=2" target="frame-content">已签收</a></span></li>
                        <li><span><a href="managerOrderSearch.php?status=3" target="frame-content">已评论</a></span></li>
                        <li><span><a href="managerOrderSearch.php?status=5" target="frame-content">交易失败</a></span></li>
                    </ul>
                </li>
                <li><span>管理员管理</span>
                    <ul class="secondary">
                        <li><span><a href="managerList.php" target="frame-content">管理员列表</a></span></li>
                        <li><span><a href="addManager.php" target="frame-content">管理员添加</a></span></li>
                    </ul>
                </li>
                <li><span><a href="managerUsers.php" target="frame-content">用户管理</a></span></li>
                <li><span><a href="managerComment.php" target="frame-content">评论管理</a></span></li>
                <li><span><a href="managerReturnGoods.php" target="frame-content">退货</a></span></li>
            </ul>
        </nav>
    </div>
	
	<iframe id="frame-content" name="frame-content" frameborder="0" scrolling="auto"  height="700px"></iframe>
    <script src="../js/managerIndex.js"></script>
	
</body>

</html>