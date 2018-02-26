<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<link href="../module/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../module/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
	*{
		padding:0;
		margin:0;
	}
	body{
		
		background-color: rgba(230,230,230,0.5); /* rgba(67,85,135,0.5)*/
	}
	
	
	img{
		width:220px;
		height:80px;
		display:block;
		float:left;
		box-shadow: 5px 5px 10px rgb(67,85,135);
		
	}
	#header{
		
		width:100%;
		height:80px;
		background-color: white;
		
	}
	
	#search{
		position:absolute;
		width:280px;
		height:40px;
		right:50px;
		top:20px;
	}
	
	input[name="search"]{
		display:block;
		height:40px;
		width:280px;
		position:relative;
		border-radius:15px;
		box-shadow: 1px 1px 2px rgb(67,85,135);
		border:1px solid rgba(207,207,207,1.00);
		text-align: center;
		margin-right:-10px;
	}
	
	.search{
		display:block;
		position: absolute;
		left:8px;
		top:5px;
		font-size:27px;
		z-index:100;
		color:rgba(214,214,214,1.00);
		
	}
</style>
</head>

<body>

<img src="../image/643e5703f4e6c6b3169cd4f2633d1e02.jpg" >
<div id="header">
	<div id="search">
		<i class="fa fa-search search" aria-hidden="true"></i>
		<input name="search"   type="text"/>
	</div>
</div>
</body>
</html>