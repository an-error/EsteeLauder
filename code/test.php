



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 默认的导航栏</title>
	<style>
		#frm{
			width:200px;
			height:200px;
			border:1px solid black;
		}
	</style>
</head>
<body>
<form action="1.php"  method="post" enctype="multipart/form-data" target="#frm">
	<input type="file" name="pic"  />
	<input type="text" name="picname" />
	<input type="submit"  value="提交" />
	<br />
</form>

<!--<iframe style="width:200px;height:200px"  name="frm" src="1.php">
		<img src="../image/2a61e19fe7f467ce79a11c06e044e917.jpg" style="z-index: 100"/>
		
	</iframe>-->
	
	<div id="frm">
		
	</div>

<script>
	var file=document.getElementsByName('pic')[0];
	
	
	
	document.getElementsByTagName('form')[0].onsubmit=function(){
		var fmdata=new FormData(this);
		var xhr=new XMLHttpRequest();
		
		xhr.onreadystatechange=function(){
			if(this.readyState==4){
				alert(this.responseText);
				/*document.getElementById('frm').innerHTML=this.responseText;*/
				
			}
		};
		xhr.open('post','2.php',true);
		xhr.send(fmdata);
		return false;
	}
	
	/*function LC(reg){
		var result=reg['s'];
		for(var i=0,str="";i<result.length;i++){
			str=str+"<li>"+result[i]+"</li>"
		}
		document.getElementsByTagName('ul')[0].innerHTML=str;
	}
	document.getElementsByTagName('input')[0].oninput=function(){
		var url="https://sp0.baidu.com/5a1Fazu8AA54nxGko9WTAnF6hhy/su?wd="+this.value+"&json=1&p=3&sid=1451_25549_21104_22073&req=2&csor=1&cb=LC";
		var s=document.createElement('script');
		s.src=url;
		document.getElementsByTagName('head')[0].appendChild(s);
		
	}
	*/
</script>
</body>
</html>