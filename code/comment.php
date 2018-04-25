<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/8
 * Time: 8:34
 */
include("conn.php");
include("module.php");
include("minHeader.php");

$sql="select * from ordergoods where id='".$_REQUEST['orderID']."' and sku='".$_REQUEST['sku']."'";
$statement=$db->query($sql);
$goods=$statement->fetch(PDO::FETCH_ASSOC);


$sql="select * from production where id='".$goods['pid']."' ";
$statement=$db->query($sql);
$pid=$statement->fetch(PDO::FETCH_ASSOC);



?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        header{
            position:relative;
        }
        #comment{
            width:950px;
            height:auto;
            margin: 100px auto;
            border:1px solid #dfe0e1;
            padding:30px;
        }

        .little-content img{
            width:150px;
            height:180px;
            margin-bottom: 20px;
        }
        .little-content div{
            width:160px;
        }

        .little-content{
            width:200px;
            float:left;
            margin-right:30px;
        }

        .comment-area textarea{
            width:600px;
            height:150px;
            padding:10px;
        }
        .comment-area input[name='show']{
            display:block;
            margin:20px;
        }

        .marking ul{
            display:block;
            list-style-type: none;
            height:50px;
            width:900px;
            line-height:50px;
        }

        .marking li{
            float:left;
        }

        .marking ul li:nth-child(7){
            display:inline-block;
            width:350px;
            height:50px;
            margin-left:100px;
            color:red;
        }

        .marking li:nth-child(1){
            display: inline-block;
            margin-right:30px;
        }

        .marking .icon-xingxing{
            font-size:35px;
            color:grey;
        }

        .marking .icon-icon-test{
            font-size:40px;
            color:gold;
        }
        .marking{
            padding:30px;
            width:900px;
            height:200px;
        }

        #comment input[name='toComment']{
            display:block;
            width:150px;
            height:40px;
            font-size:16px;
            background-color: #265a88;
            color:white;
            border:none;
            margin:40px auto 30px auto;
        }

        .comment-area .message{
            height:350px;
            padding:20px;
        }

        .fake{
            position:relative;
        }
        .fake input{
            opacity:0;
            position:absolute;
            left:260px;
            top:20px;
        }
        .fake .iconfont{
            font-size:40px;
            position:absolute;
            left:260px;
        }

        .fake .iconfont span{
            font-size:15px;
            margin-left:20px;
        }

        .fake .iconfont span:nth-child(2){
            color:grey;
        }

        #imgContent{
            width:600px;
            height:100px;
            //background-color: #265a88;;
            margin:80px auto auto 200px;
        }

        #imgContent img{
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

    </style>
</head>

<body>

    <div id="comment" sku="<?php echo $_REQUEST['sku']?>" orderID="<?php echo $_REQUEST['orderID']?>">
        <div class="comment-area">
            <div class="message">
            <div class="little-content">
                <img src="<?php echo $pid['img']?>"/>
                <div><?php echo $pid['name']?></div>
            </div>

                <textarea placeholder="写下您的感想吧"></textarea>
                <div class="fake">
                    <i class="iconfont icon-photo"><span>晒照片</span><span>最多可上传5张</span></i>
                    <form name="send">
                    <input type="file" name="files" multiple onchange="preview(this)" accept="image/jpeg,image/gif,image/png"/>
                    </form>
                </div>
                <div id="imgContent">

                </div>
            </div>
            <hr/>
            <div class="marking">
                <ul class="one">
                    <li>宝贝与描述相符</li>
                    <li><i class="iconfont icon-xingxing" index="0"></i></li>
                    <li><i class="iconfont icon-xingxing" index="1"></i></li>
                    <li><i class="iconfont icon-xingxing" index="2"></i></li>
                    <li><i class="iconfont icon-xingxing" index="3"></i></li>
                    <li><i class="iconfont icon-xingxing" index="4"></i></li>
                    <li></li>
                </ul>
                <ul class="two">
                    <li>我们的服务态度</li>
                    <li><i class="iconfont icon-xingxing" index="0"></i></li>
                    <li><i class="iconfont icon-xingxing" index="1"></i></li>
                    <li><i class="iconfont icon-xingxing" index="2"></i></li>
                    <li><i class="iconfont icon-xingxing" index="3"></i></li>
                    <li><i class="iconfont icon-xingxing" index="4"></i></li>
                    <li></li>
                </ul>
                <ul class="three">
                    <li>物流的服务质量</li>
                    <li><i class="iconfont icon-xingxing" index="0"></i></li>
                    <li><i class="iconfont icon-xingxing" index="1"></i></li>
                    <li><i class="iconfont icon-xingxing" index="2"></i></li>
                    <li><i class="iconfont icon-xingxing" index="3"></i></li>
                    <li><i class="iconfont icon-xingxing" index="4"></i></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <hr/>
        <input type="button" value="发表评价" name="toComment"/>
    </div>

    <script>

        var tip=[];
        var temp=[];
        temp[0]="差得太离谱，与描述严重不符，非常不满";
        temp[1]="部分有破损，与描述不符，不满意";
        temp[2]="质量一般，没有描述中的那么好";
        temp[3]="质量不错，与卖家描述的基本一致，还是挺满意的";
        temp[4]="质量非常好，与卖家描述的完全一致，非常满意";

        tip[0]=temp;
        var temp1=[];
        temp1[0]="态度很差，还骂人、说脏话，简直不把顾客当回事";
        temp1[1]="有点不耐烦，承诺的服务也兑现不了";
        temp1[2]="回复问题很慢，态度一般，谈不上沟通顺畅";
        temp1[3]="服务挺好的，沟通挺顺畅的，总体满意";
        temp1[4]="服务太棒了，考虑非常周到，完全超出期望值";
        tip[1]=temp1;

        var temp2=[];
        temp2[0]="到货速度严重延误，货物破损，派件员态度恶劣";
        temp2[1]="到货速度慢，外包装严重变形，派件员不耐烦，态度差";
        temp2[2]="到货速度一般，外包装变形，派件员态度一般";
        temp2[3]="到货速度及时，派件员态度较好";
        temp2[4]="到货速度非常快，商品完好无损，派件员态度很好";
        tip[2]=temp2;

        var collection=[];
        $(".marking").on("mouseover mouseout",".one i",function(e){
            var ul=this.parentNode.parentNode;
            var stars=ul.getElementsByTagName("i");
            var index=parseInt(this.getAttribute('index'));
            if(e.type==="mouseover"){

                for(var i=0; i<5;i++ ){
                    if(i<index+1){
                        stars[i].classList.add("icon-icon-test");
                    }else{
                        stars[i].classList.remove("icon-icon-test");
                    }
                }

                $(ul).find("li").eq(6).text(tip[0][index]);
            }

            if(e.type==="mouseout"){
                if(e.target.nodeName!=="i"){
                    for(var i=0; i<5;i++ ){
                        stars[i].classList.remove("icon-icon-test");
                    }
                }
                $(ul).find("li").eq(6).text("");
            }


        });

        $(".marking").on("mouseover mouseout",".two i",function(e){
            var ul=this.parentNode.parentNode;
            var stars=ul.getElementsByTagName("i");
            var index=parseInt(this.getAttribute('index'));
            if(e.type==="mouseover"){

                for(var i=0; i<5;i++ ){
                    if(i<index+1){
                        stars[i].classList.add("icon-icon-test");
                    }else{
                        stars[i].classList.remove("icon-icon-test");
                    }
                }

                $(ul).find("li").eq(6).text(tip[1][index]);
            }

            if(e.type==="mouseout"){
                if(e.target.nodeName!=="i"){
                    for(var i=0; i<5;i++ ){
                        stars[i].classList.remove("icon-icon-test");
                    }
                }
                $(ul).find("li").eq(6).text("");
            }

        });

        $(".marking").on("mouseover mouseout",".three i",function(e){
            var ul=this.parentNode.parentNode;
            var stars=ul.getElementsByTagName("i");
            var index=parseInt(this.getAttribute('index'));
            if(e.type==="mouseover"){

                for(var i=0; i<5;i++ ){
                    if(i<index+1){
                        stars[i].classList.add("icon-icon-test");
                    }else{
                        stars[i].classList.remove("icon-icon-test");
                    }
                }
                $(ul).find("li").eq(6).text(tip[2][index]);


            }

            if(e.type==="mouseout"){
                if(e.target.nodeName!=="i"){
                    for(var i=0; i<5;i++ ){
                        stars[i].classList.remove("icon-icon-test");
                    }
                }
                $(ul).find("li").eq(6).text("");
            }

        });




        $(".marking").on("click","i",function(){
            var ul=this.parentNode.parentNode;
            var stars=ul.getElementsByTagName("i");
            var index=parseInt(this.getAttribute('index'));
            for(var i=0; i<5;i++ ){
                if(i<index+1){
                    stars[i].classList.add("icon-icon-test");
                }else{
                    stars[i].classList.remove("icon-icon-test");
                }
            }

            var sign=0;
            if(ul.className==='one'){
                collection[0]=index+1;
                $(ul).find("li").eq(6).text(tip[sign][index]);
                $(".marking").off("mouseover mouseout",".one i");
            }
            if(ul.className==='two'){
                sign=1;
                collection[1]=index+1;
                $(ul).find("li").eq(6).text(tip[sign][index]);
                $(".marking").off("mouseover mouseout",".two i");
            }

            if(ul.className==='three'){
                sign=2;
                collection[2]=index+1;
                $(ul).find("li").eq(6).text(tip[sign][index]);
                $(".marking").off("mouseover mouseout",".three i");
            }
        })


        //图片预览
        function preview(target){
            var length=0;
            var imgContent=document.getElementById('imgContent');
            imgContent.innerHTML="";
            var reader=new FileReader();
            reader.readAsDataURL(target.files[length]);
            reader.onload=function(){
                imgContent.innerHTML+="<div class='img-preview'><img src='"+this.result+"'/><span>x</span></div>";
                length++;
                if(length<target.files.length){
                    reader.readAsDataURL(target.files[length]);
                }

            }
        }

        var delFilesIndex=[];

        $("#imgContent").on("click ",".img-preview span",function(){
            $(this.parentNode).css("display","none");
            delFilesIndex.push($("#imgContent .img-preview").index(this.parentNode));
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
            for(var i=0;i<files.length;i++){
                if(!isInArray(i,delFilesIndex)){
                    filesData.push(files[i]);
                }
            }
            return filesData;
        }

        document.getElementsByName("toComment")[0].onclick=function(){
            if(collection.length===3){
                console.log(collection);
                var form=document.getElementsByTagName('from')[0];
                var data=new FormData(form);
                data.append('stars',collection);
                var text=document.getElementsByTagName('textarea').innerText;
                data.append("text",text);
                var sku=document.getElementById('comment').getAttribute('sku');
                data.append('sku',sku);
                var orderID=document.getElementById('comment').getAttribute('orderID');
                data.append('orderID',orderID);
                var files=getFilesDate();
                for(var i=0;i<files.length && i<5;i++){
                    data.append('img'+i,files[i]);
                }

                var xhr=new XMLHttpRequest();
                xhr.onreadystatechange=function(){
                    if(this.readyState===4){
                        alert(this.responseText);
                        location.href="user.php";
                    }
                };
                xhr.open("post","addComment.php",true);
                xhr.send(data);
            }else{
                alert("请评分！")
            }



        }


    </script>

</body>
</html>
