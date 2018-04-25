
<?php 
	include("module.php");
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
    body{
        font-size:18px;
    }
	.error{
		color:red;
	}	
	.text{
		display:inline-block;
		width:150px;
		text-align: right;
		
	}
    #content{
        padding:50px;
        display:block;
        width:600px;
        height:400px;
        position:relative;
        margin:180px auto;
        border:1px solid #dfe0e1;
    }

    input[type="button"]{
        display:inline-block;
        width:100px;
        height:30px;
        border:none;
        margin-top:30px;
        background-color:#265a88;
        color:whitesmoke;
        position: absolute;
        left:43%;
    }


    input[type="text"],input[type="password"]{
        border:2px solid gainsboro;
        border-radius: 5px;
    }
</style>
</head>

<body>
<div id="content">
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">
	<p><span class="text">用户名：</span><input type="text" name="username" /><span class="error"></span></p>
	<p><span class="text">密码：</span><input type="password" name="password" /><span class="error"></span></p>
	<p><span class="text">再次输入密码：</span><input type="password" name="password2" /><span class="error"></span></p>
	<p><span class="text">手机号码：</span><input type="text" name="phone" /><span class="error"></span></p>
	<p><span class="text">身份证号码：</span><input type="text" name="IDCard" /><span class="error"></span></p>
	
	<p><span class="text">邮箱：</span><input type="text" name="email" /><span class="error"></span></p>
	<input type="button" value="注册" name="submit"/>

</form>
</div>

<script id="return"></script>
<script>
    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }


    document.getElementsByName("submit")[0].onclick=function() {
        var formObject=document.getElementById('form1');
        var formData = new FormData(formObject);
        var xhr = new XMLHttpRequest();
        var result;
        xhr.onreadystatechange = function () {

            if (this.readyState === 4) {
                result = this.responseText;
                if (isJson(result)) {

                    result = eval("(" + this.responseText + ")");

                    if (result.length !== 0) {
                        if (result['username']) {
                            document.getElementsByClassName('error')[0].innerHTML = result['username'];
                        }
                        if (result['password']) {
                            document.getElementsByClassName('error')[1].innerHTML = result['password'];
                        }
                        if (result['password2']) {
                            document.getElementsByClassName('error')[2].innerHTML = result['password2'];
                        }
                        if (result['phone']) {
                            document.getElementsByClassName('error')[3].innerHTML = result['phone'];
                        }
                        if (result['IDCard']) {
                            document.getElementsByClassName('error')[4].innerHTML = result['IDCard'];
                        }


                        if (result['email']) {
                            document.getElementsByClassName('error')[5].innerHTML = result['email'];
                        }
                    }
                } else {
                    document.getElementById('return').innerText = result;
                    location.href="managerList.php";
                }

            }
        };
        xhr.open('post','addManagerCheck.php',true);
        xhr.send(formData);


        return false;
    }

	
</script>

</body>
</html>