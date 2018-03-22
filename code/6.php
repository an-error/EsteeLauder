
<?php 
	include("module.php");
	include("conn.php");
    $id=$_REQUEST['id'];
    $statement=$db->prepare("select * from manager where id=:id");

    $statement->execute(array(':id'=>$id));
    $row=$statement->fetch(PDO::FETCH_ASSOC);
   /* print_r($row);*/
   //execute返回布尔值！PDOStatement是一个类！

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	.error{
		color:red;
	}	
	.text{
		display:inline-block;
		width:100px;
		text-align: right;
		
	}
    #content{
        display:block;
        width:600px;
        height:400px;
        position:absolute;
        left:37%;
        top:20%;
    }

    input[type="button"]{
        display:inline-block;
        width:100px;
        height:30px;
        border:none;
        margin-top:30px;
        background-color:steelblue;
        color:whitesmoke;
        position: relative;
        border-radius: 5px;
    }
    input[name="cancel"]{
        left:8%;
    }

    input[name="edit"]{
        left:28%;
    }

    input[type="text"],input[type="password"]{
        border:none;
        border:2px solid gainsboro;
        border-radius:8px;
    }

    #password2{
        display:none;
    }
</style>
</head>

<body>
<div id="content">
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">
     <p><span class="text">账号：</span><input type="text" name="" value="<?php echo $row['id']?>" disabled="disabled"/></p>
	<p><span class="text">用户名：</span><input type="text" name="username" value="<?php echo $row['name']?>"/><span class="error"></span></p>
	<p><span class="text">密码：</span><input type="password" name="password" value="<?php echo $row['password']?>"/><span class="error"></span></p>
	<p  id="password2"><span class="text">再次输入密码：</span><input type="password" name="password2"  /><span class="error"></span></p>
	<p><span class="text">手机号码：</span><input type="text" name="phone" value="<?php echo $row['phone']?>"/><span class="error"></span></p>
	<p><span class="text">身份证号码：</span><input type="text" name="IDCard" value="<?php echo $row['IDCard']?>"/><span class="error"></span></p>
	
	<p><span class="text">邮箱：</span><input type="text" name="email" value="<?php echo $row['email']?>" /><span class="error"></span></p>
     <input type="button" value="取消" name="cancel"/>
     <input type="button" value="编辑" name="edit"/>

</form>
</div>

<script id="return"></script>
<script>
    function isJson(str) {
        try {
            var obj=JSON.parse(str);
            if(typeof obj == 'object' && obj ){
                return true;
            }else{
                return false;
            }

        } catch(e) {
            console.log('error：'+str+'!!!'+e);
            return false;
        }
        return false;
    }



    document.getElementsByName("edit")[0].onclick=function() {
        var isEdit=confirm("是否确认编辑？编辑之后不可恢复！");
        if(isEdit===true){
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
            xhr.open('post','editManagerCheck.php?id=<?php echo $id?>',true);
            xhr.send(formData);


            return false;
        }

    };

    document.getElementsByName('password')[0].onchange=function(){
       document.getElementById('password2').style.cssText="display:block";
    };

    document.getElementsByName('cancel')[0].onclick=function(){
        var isCancel=confirm("是否取消此次操作？");
        if(isCancel===true){
            history.go(-1);
        }
    }
	
</script>

</body>
</html>