<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/18
 * Time: 10:07
 */

include('module.php');
include('conn.php');

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
        #imgContent img{
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
            display:block;
            width:100px;
            height:30px;
            margin:100px 26% auto auto;
        }
    </style>
</head>

<body>
<div id="content">
    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <fieldset>
        <legend>商品名称：<span id="goodsName" class="error"></span></legend>
        <p>商品名称：<input type="text" name="pName" /><span id="goodsName" class="error"></span></p>
    </fieldset>

    <fieldset>
        <legend>商品品牌：</legend>
        <div class="radio">
            <input type="radio" id="radio1" name="brand" value="EsteeLauder" checked/>
            <label for="radio1"><img src="../image/esteeLauder.jpeg" /> </label>
        </div>

        <div class="radio">
            <input type="radio" id="radio2" name="brand" value="Tom Ford"/>
            <label for="radio2"><img src="../image/TF.jpg" /> </label>
        </div>

        <div class="radio">
            <input type="radio" id="radio3" name="brand" value="Bobbi Brown"/>
            <label for="radio3"><img src="../image/bobbiBrown.jpg" /> </label>
        </div>

    </fieldset>
   <fieldset>
       <legend>分类：<span id="cateText"></span><span class="error" id="categories"></span></legend>
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
             <li onmousedown="down('唇彩笔')">唇彩笔</li>
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
    <fieldset >
        <legend >图片上传<span class="error" id="myFile"></span></legend>
        <p>主图：<input type="file" name="pic" accept="image/jpeg,image/gif,image/png" onchange="preview(this)"/></p>
        <p>附图：<input type="file" name="files" accept="image/jpeg,image/gif,image/png" onchange="preview(this)" multiple/></p>
        <div id="imgContent"></div>
    </fieldset>
     <fieldset>
         <legend>商品介绍</legend>
         <textarea name="productionText" style="width:600px;height:400px;"></textarea>
     </fieldset>

    <input type="button" value="下一步" name="submit" />
    </form>

</div>

<div id="text"></div>
<script id="win"></script>
<script>
//图片预览
    function preview(target){
        var length=0;
        var imgContent=document.getElementById('imgContent');
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
    var categories="";

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

    document.getElementsByName("submit")[0].onclick=function(){
        var form=document.getElementsByTagName("form")[0];
        var formData=new FormData(form);
        var brand=$("input[name='brand']:checked").val();
        formData.append("brand",brand);
        formData.append("categories",categories);

        var files=document.getElementsByName("files")[0].files;
        if(files.length>4){
            alert("只能上传四张图片！多余的图片无效！！")
        }
        for (var i=0;i<files.length;i++){
            formData.append('img'+i,files[i]);
        }
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                var result=JSON.parse(this.responseText);
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
                        window.location="addProductionAtrr.php?id="+result['id'];
                }
            }
        };

        xhr.open("post","addProductionCheck.php",true);
        xhr.send(formData);

    }



</script>
</body>
</html>
