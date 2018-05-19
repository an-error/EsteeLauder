
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

