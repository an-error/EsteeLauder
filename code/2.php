<?php
include("conn.php");
include("module.php");

$sql="select * from comment ";
$statement=$db->query($sql);
$result=$statement->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <link href="../module/download/font_609056_zobu4g0ihwmz33di" rel="stylesheet"/>
    <style>

        .img-preview{
            width:100px;
            height:100px;
            display:inline-block;
            margin:10px;
            position:relative;
        }
        .img-preview span{
            position:absolute;
            top:5px;
            left:5px;
            color:white;
        }
        .img-preview img{
            width:100px;
            height:100px;
        }

        .img-preview span:hover{
            color:grey;
        }

        .iconfont{
            font-size:50px;
        }

    </style>
</head>
<body>
<!--<div class="img-preview">
    <img src="../img/1.jpg"/>
    <span>x</span></div>
<div class="img-preview">
    <img src="../img/1.jpg"/>
    <span>x</span>
</div>-->

<!--<p>附图：<input type="file" name="files" accept="image/jpeg,image/gif,image/png" onchange="preview(this)" multiple/></p>
<div id="imgContent2"></div>-->
<i class="iconfont icon-fanhui-01-01"></i>

<script>
    $(".img-preview span").click(function(){
        $(this.parentNode).attr("del",true);
        $(this.parentNode).css("display","none");
        console.log($("#imgContent2 .img-preview").index(this.parentNode));

    })

    function preview(target){
        var length=0;
        if(target.name==="pic"){
            var imgContent=document.getElementById('imgContent');
            var reader=new FileReader();
            reader.readAsDataURL(target.files[length]);
            reader.onload=function(){
                imgContent.innerHTML="<img src='"+this.result+"'/>";
                length++;
                if(length<target.files.length){
                    reader.readAsDataURL(target.files[length]);
                }

            }
        }else{
            var imgContent=document.getElementById('imgContent2');
            var reader=new FileReader();
            reader.readAsDataURL(target.files[length]);
            reader.onload=function(){
                imgContent.innerHTML+="<div class='img-preview' ><img src='"+this.result+"'/><span>x</span></div>";
                length++;
                if(length<target.files.length){
                    reader.readAsDataURL(target.files[length]);
                }

            }
        }


    }

    function getFilesDate(){
        var files=$("input[name='files']")[0].files;
        var filesData=[];
        for(var i=0;i<files.length;i++){
            if(!files[i].getAttribute('del')){
                filesData.push(files[i]);
            }
        }
    }



</script>
</body>
</html>
