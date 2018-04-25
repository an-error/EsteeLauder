<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/13
 * Time: 10:34
 */

include("minHeader.php");
include("module.php");
include("conn.php");

$sql="select * from esteelauder.order where id='".$_REQUEST['orderID']."'";
$statement=$db->query($sql);
$result=$statement->fetch(PDO::FETCH_ASSOC);


$sql="select * from returnGoods where orderID='".$_REQUEST['orderID']."'";
$statement=$db->query($sql);
$return=$statement->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        body{
            background-color: #EEEEEE;
        }

        .return-content{
            width:500px;
            height:auto;
            background-color: white;
            margin:150px auto;
            padding:30px;
            font-size:17px;
        }
        fieldset p{
            margin:30px auto;
        }

        fieldset select{
            width:210px;
            height:30px;
        }

        .return-img-content{
            width:400px;
            height:150px;
        }

        .return-content input[type="button"]{
            padding:5px;
            border:none;
            background-color: #265a88;
            color:white;
            margin-top:10px;
            font-size:15px;
            width:130px;
        }

        .fake i{
            font-size:40px;
            position:absolute;
            top:-18px;
        }

        .fake{
            position:relative;
        }

        .fake input{
            position:relative;
            opacity: 0;
            z-index:10;
        }
        .fake span{
            font-size:10px;
        }

        .smail{
            font-size:10px;
            display:inline-block;
        }

        .return-img-content img{
            margin-top:30px;
            width:100px;
            height:100px;
        }

        .img-preview{
            width:100px;
            height:100px;
            display:inline-block;
            margin:10px;
            position:relative;
        }
        .img-preview span{
            position:absolute;
            top:8px;
            left:10px;
            color:grey;
        }
        .img-preview img{
            width:100px;
            height:100px;
        }

        .img-preview span:hover{
            color:red;
        }

        .error{
            font-size:10px;
            color:red;
        }

        .info{
            font-size:19px;
            color:red;
            margin-left: 150px;
        }

        .space{
            margin-left:200px;
        }



    </style>
</head>

<body>
    <?php if(!$return):?>
    <div class="return-content" orderID="<?php echo $_REQUEST['orderID']?>">
        <fieldset>
            <legend>申请退货</legend>
            <form>
            <p>退货原因：
                <select name="reason">
                    <option>商品破损</option>
                    <option>其他</option>
                </select>
            </p>
            <p>退款金额：<input type="number" name="price" placeholder="<?php echo $result['total']?>"/><span class="error"></span></p>
            <p>退款说明：<input type="text" name="text" /><span class="error"></span></p>
            <div class="fake">
                <input type="file" name="files" multiple onchange="preview(this)"/>
                <i class="iconfont icon-photo"></i>
                <span>上传凭证</span>
                <span class="pull-right">*最多上传3张*</span>
            </div>
            <div class="return-img-content">

            </div>
            <hr/>
            <p class="smail">*除非商品破损否则不允退货*</p>
            <input type="button" value="申请退货" name="apply" class="pull-right"/>
            </form>
        </fieldset>
    </div>

    <?php else:?>
    <div class="return-content" returnID="<?php echo $return['id']?>">
        <fieldset>
            <legend>申请退货</legend>
            <form>
                <p>退货原因：<input type="text" placeholder="<?php echo $return['reason']?>"  disabled="disabled"/></p>
                <p>退款金额：<input type="number" name="price" placeholder="<?php echo $return['price']?>" disabled="disabled"/></p>
                <p>退款说明：<input type="text" name="text" placeholder="<?php echo $return['text']?>" disabled="disabled"/></p>
                <div class="fake">
                    <input type="file" name="files" multiple onchange="preview(this)" disabled="disabled"/>
                    <i class="iconfont icon-photo"></i>
                    <span>凭证</span>
                </div>
                <div class="return-img-content">
                    <img src="<?php echo $return['img0']?>" />
                    <img src="<?php echo $return['img1']?>" />
                    <img src="<?php echo $return['img2']?>" />
                </div>
                <hr/>

                <?php if($return['status']=="申请退货"):?>
                <input type="button" value="等待商家处理" name="wait" class="pull-right"/>
                <?php endif;?>
                <?php if($return['status']=="驳回申请"):?>
                    <p class="info">申请已驳回！</p>
                <?php endif;?>

                <?php if($return['status']=="允许退货"):?>
                    <div class="return-express">
                    <p>等待买家退货<span class="smail space">*只允许寄顺丰*</span></p>
                    <p><input type="radio"  checked/>顺丰速运</p>
                    <p>快递单号：<input type="number"  name="express" /></p>
                        <input type="button" value="寄出" name="delivery" class="pull-right"/>
                    </div>
                <?php endif;?>

                <?php if($return['status']=="买家已寄出"):?>
                    <div class="return-express">
                        <p><input type="radio"  checked/>顺丰速运</p>
                        <p>快递单号：<input type="number"  name="express" placeholder="<?php echo $return['delivery']?>" disabled="disabled"/></p>
                        <input type="button" value="等待商家确认收货"  class="pull-right"/>
                    </div>
                <?php endif;?>

                <?php if($return['status']=="退回"):?>
                    <div>
                        <p class="info">商品经检查发现已使用，已退回</p>
                        <p><input type="radio"  checked/>顺丰速运</p>
                        <p>快递单号：<input type="number"  placeholder="<?php echo $return['backDelivery']?>" disabled="disabled"/></p>

                    </div>

                <?php endif;?>

                <?php if($return['status']=="退款"):?>
                    <p class="info">商家已退款</p>

                <?php endif;?>


                <p class="smail">*除非商品破损否则不允退货*</p>
            </form>
        </fieldset>
    </div>
    <?php endif;?>

<script>

    //无效图片
    $("img").each(function(){
        if($(this).attr("src")===""){
            $(this).css("display","none");
        }
    });
    //预览
    function preview(target){
        var length=0;
        var imgContent=document.getElementsByClassName('return-img-content')[0];
        imgContent.innerHTML="";
        var reader=new FileReader();
        reader.readAsDataURL(target.files[length]);
        reader.onload=function(){
            imgContent.innerHTML+="<div class='img-preview'><img src='"+this.result+"'/><span>x</span></div>";
            length++;
            if(length<target.files.length && length<3){
                reader.readAsDataURL(target.files[length]);
            }

        }
    }

    var delFilesIndex=[];

    $(".return-img-content").on("click ",".img-preview span",function(){
        $(this.parentNode).css("display","none");
        delFilesIndex.push($(".return-img-content .img-preview").index(this.parentNode));
    });

    function isInArray(index,delIndex){
        for(var i=0;i<delIndex.length;i++){
            if(index===delIndex[i]){
                return true;
            }
        }
        return false;
    }

    function getFilesDate(){
        var files=$("input[name='files']")[0].files;
        var filesData=[];
        for(var i=0;i<files.length && i<3;i++){
            if(!isInArray(i,delFilesIndex)){
                filesData.push(files[i]);
            }
        }
        return filesData;
    }

    $("input[name='price']").blur(function(){
        var max=$(this).attr("placeholder");
        var value=parseInt($(this).val());
        console.log(value);
        if(value>max){
            $(this).next().text("不能大于付款金额");
        }
    });

    $(".return-content").on("click","input[name='apply']",function(){
        var orderID=document.getElementsByClassName("return-content")[0].getAttribute("orderID");
        var form=document.getElementsByClassName("return-content")[0].getElementsByTagName("form")[0];
        var data=new FormData(form);
        data.append("orderID",orderID);
        var price=document.getElementsByName("price")[0].value;
        data.append("price",price);
        var files=getFilesDate();
        for(var i=0;i<files.length;i++){
            data.append("img"+i,files[i]);
        }
        data.append("status","apply");

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                var result=JSON.parse(this.responseText);
                if(result['error']){
                    var span=document.getElementsByClassName("error");
                    if(result['error']['price']){
                        span[0].innerText=result['error']['price'];
                    }
                    if(result['error']['text']){
                        span[1].innerText=result['error']['text'];
                    }
                }
                location.reload();
            }
        };
        xhr.open("post","returnCheck.php",true);
        xhr.send(data);
    });

    $(".return-content").on("click","input[name='delivery']",function(){
        var delivery=document.getElementsByName('express')[0].value;
        if(delivery===""){
            alert("请输入快递单号");
        }else{
            var data=new FormData();
            data.append("status","delivery");
            data.append("delivery",delivery);
            var returnID=document.getElementsByClassName("return-content")[0].getAttribute("returnID");
            data.append("returnID",returnID);
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                    location.reload();
                }
            };
            xhr.open("post","returnCheck.php",true);
            xhr.send(data);
        }
    })



</script>
</body>
</html>
