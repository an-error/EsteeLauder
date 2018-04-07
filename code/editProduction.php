<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/18
 * Time: 10:07
 */

include('module.php');
include('conn.php');
$id=$_REQUEST['id'];
$sql="select * from production where id='".$id."'";
$statement=$db->query($sql);
$result=$statement->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加商品</title>
    <style>

        .radio img{
            width:100px;
            height:100px;
        }

        .radio{
            width:160px;
            height:160px;
            float:left;
            margin-left:40px;

        }


        ul{
            list-style-type: none;
        }

        .major{
            display:block;
            width:100px;
            height:50px;
            position:absolute;
            left:20px;
        }

        #lip{
            top:10px;
        }

        #eye{
            top:25px;
        }

        #face{
            top:40px;
        }
        .minor{
            display:none;
            width:200px;
            height:200px;
            position:relative;
            right:-100px;
        }
        .major li:hover{
            border:1px solid grey;
        }
        .minor li:hover{
            background-color:darkgray;
        }
        .error{
            color:red;
            font-size:15px;
            display:block;
            margin:0 0 0 200px;
        }
        #imgContent img,#previewContent img{
            width:100px;
            height:100px;
            display:inline-block;
            margin:10px;
        }

        #content{
            margin:30px;
            padding:20px;
            width:800px;
        }

        input[name="submit"]{
            display:inline-block;
            width:100px;
            height:30px;
            margin:100px auto 100px 400px ;
        }

        input[name='back']{
            display:inline-block;
            margin-top:100px;
        }


    </style>
</head>

<body>
<div id="send" style="display:none;"><?php echo $id?></div>
<div id="content">
    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <fieldset>
        <legend>商品名称：<span id="goodsName" class="error"></span></legend>
        <p>商品名称：<input type="text" name="pName" value="<?php echo $result['name']?>"/><span id="goodsName" class="error"></span></p>
    </fieldset>

    <fieldset>
        <legend>商品品牌：</legend>
        <div class="radio">
            <input type="radio" id="radio1" name="brand" value="EsteeLauder" <?php if($result['brand']!="Tom Ford" && $result['brand']!="Bobbi Brown")echo "checked"?>/>
            <label for="radio1"><img src="../image/esteeLauder.jpeg" /> </label>
        </div>

        <div class="radio">
            <input type="radio" id="radio2" name="brand" value="Tom Ford" <?php if($result['brand']!="EsteeLauder" && $result['brand']!="Bobbi Brown")echo "checked"?>/>
            <label for="radio2"><img src="../image/TF.jpg" /> </label>
        </div>

        <div class="radio">
            <input type="radio" id="radio3" name="brand" value="Bobbi Brown" <?php if($result['brand']!="EsteeLauder" && $result['brand']!="Tom Ford")echo "checked"?>/>
            <label for="radio3"><img src="../image/bobbiBrown.jpg" /> </label>
        </div>

    </fieldset>
   <fieldset>
       <legend>分类：<span id="cateText"><?php echo $result['categories']?></span><span class="error" id="categories"></span></legend>
     <div style="clear:left; width:400px;height:160px;">

         <ul class="major">
             <li id="lip" onmouseover="over('lipClass')" >唇部
             </li>
             <li id="eye" onmouseover="over('eyeClass')" >眼部

             </li>
             <li id="face" onmouseover="over('faceClass')" >面部

             </li>
         </ul>

         <ul class="minor" id="lipClass">
             <li onmousedown="down('唇彩')">唇彩</li>
             <li onmousedown="down('唇线笔')">唇线笔</li>
             <li onmousedown="down('唇膏')">唇膏</li>
             <li onmousedown="down('唇釉')">唇釉</li>
         </ul>

         <ul class="minor" id="eyeClass">
             <li onmousedown="down('眼影')">眼影</li>
             <li onmousedown="down('眼线笔')">眼线笔</li>
             <li onmousedown="down('睫毛膏')">睫毛膏</li>
             <li onmousedown="down('眉笔')">眉笔</li>
         </ul>

         <ul class="minor" id="faceClass">
             <li onmousedown="down('粉底液')">粉底液</li>
             <li onmousedown="down('粉饼')">粉饼</li>
             <li onmousedown="down('气垫')">气垫</li>
             <li onmousedown="down('妆前乳')">妆前乳</li>
             <li onmousedown="down('腮红')">腮红</li>
             <li onmousedown="down('遮瑕膏')">遮瑕膏</li>
         </ul>
     </div>
   </fieldset>
   <fieldset>
      <legend>规格：<span class="error" id="size"></span></legend>
      <input type="text" name="size"  value="<?php echo $result['size']?>"/>
   </fieldset>
    <fieldset >
        <legend >图片上传<span class="error" id="myFile"></span></legend>
        <p>主图：<input type="file" name="pic" accept="image/jpeg,image/gif,image/png" onchange="preview(this)"/></p>
        <p>附图：<input type="file" name="files" accept="image/jpeg,image/gif,image/png" onchange="preview(this)" multiple/></p>
        <div id="imgContent">
            <img src="<?php echo $result['img']?>" />
            <img src="<?php if(!empty($result['img0']))echo $result['img0']?>"/>
            <img src="<?php if(!empty($result['img1']))echo $result['img1']?>"/>
            <img src="<?php if(!empty($result['img2']))echo $result['img2']?>"/>
            <img src="<?php if(!empty($result['img3']))echo $result['img3']?>"/>
        </div>
        <div id="previewContent"></div>
    </fieldset>
     <fieldset>
         <legend>商品介绍</legend>
         <textarea name="productionText" style="width:600px;height:400px;"><?php echo $result['text']?></textarea>
     </fieldset>

    <input type="button" value="返回上一页" name="back" onclick="history.go(-1);"/>
    <input type="button" value="下一步" name="submit" />
    </form>

</div>

<div id="text"></div>
<script id="win"></script>
<script>


    window.onload=function(){
        var img=document.getElementsByTagName("img");
        for(var i=0;i<img.length;i++){
            if(img[i].getAttribute('src')===""){
                img[i].style.cssText="display:none";
            }

        }
    };



//图片预览
    var flag=0;
    function preview(target){
        flag=1;
        document.getElementById('imgContent').style.cssText="display:none";
        var length=0;
        var imgContent=document.getElementById('previewContent');
        var reader=new FileReader();
        reader.readAsDataURL(target.files[length]);
        reader.onload=function(){
                imgContent.innerHTML+="<img src='"+this.result+"'/>";
                length++;
                if(length<target.files.length){
                    reader.readAsDataURL(target.files[length]);
                }

        }
    }


//分类
    var categories=document.getElementById("cateText").innerText;

    function setNone(className){
        var arr=document.getElementsByClassName(className);
        for(var i=0;i<arr.length;i++){
            arr[i].style.cssText="display:none";
        }
    }

    function over(id){
       setNone("minor");
        var li=document.getElementById(id);
        li.style.cssText="display:block";
    }

    function down(str){
        categories=str;
        document.getElementById("cateText").innerHTML=str;
       /* setNone("minor");
        setNone("major");*/
    }
//ajax
    document.getElementsByName("submit")[0].onclick=function(){
        var go=confirm("是否编辑？编辑之后不可撤回！");
        if(go){
            var form=document.getElementsByTagName("form")[0];
            var formData=new FormData(form);
            var brand=$("input[name='brand']:checked").val();
            var id=document.getElementById('send').innerText;
            formData.append("brand",brand);
            formData.append("categories",categories);
            formData.append("id",id);

            var files=document.getElementsByName("files")[0].files;
            if(files.length>4){
                alert("只能上传四张图片！多余的图片无效！！")
            }



            formData.append('flag',flag);
            for (var i=0;i<files.length;i++){
                formData.append('img'+i,files[i]);
            }
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                    var result=JSON.parse(this.responseText);
                    console.log(result);
                    var error=result['error'];
                    if(error.length!==0){

                        if(error['file']){
                            document.getElementById('myFile').innerText=error['file'];
                            if(error['files']){
                                document.getElementById('myFile').innerText+=error['files'];
                            }
                        }
                        if(error['pName']){
                            document.getElementById('goodsName').innerText=error['pName'];
                        }
                        if(error['categories']){
                            document.getElementById('categories').innerText=error['categories'];
                        }
                        if(error['files']){
                            document.getElementById('myFile').innerText=error['files'];
                        }

                    }else{
                        if(result['success']){
                            window.location="editProductionAtrr.php?id="+id;
                        }else{
                            alert(result['fail']);
                        }

                    }
                }
            };

            xhr.open("post","editProductionCheck.php",true);
            xhr.send(formData);

        }

    }



</script>
</body>
</html>
