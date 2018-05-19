
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
});


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
        if(length<target.files.length && length<5){
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
        var text=document.getElementsByTagName('textarea')[0].value;
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
