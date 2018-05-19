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
    <link href="../style/editProduction.css" rel="stylesheet"/>
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
            <input type="radio" id="radio1" name="brand" value="her" checked/>
            <label for="radio1"><img src="../image/152543745182553.jpg" /> </label>
        </div>

       <!-- <div class="radio">
            <input type="radio" id="radio2" name="brand" value="Tom Ford" <?php /*if($result['brand']!="EsteeLauder" && $result['brand']!="Bobbi Brown")echo "checked"*/?>/>
            <label for="radio2"><img src="../image/TF.jpg" /> </label>
        </div>

        <div class="radio">
            <input type="radio" id="radio3" name="brand" value="Bobbi Brown" <?php /*if($result['brand']!="EsteeLauder" && $result['brand']!="Tom Ford")echo "checked"*/?>/>
            <label for="radio3"><img src="../image/bobbiBrown.jpg" /> </label>
        </div>
-->
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
<script src="../js/editProduction.js"></script>
</body>
</html>
