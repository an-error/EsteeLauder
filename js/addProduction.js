//图片预览
function preview(target){
    var length=0;
    if(target.name==="pic"){
        var imgContent=document.getElementById('imgContent');
        imgContent.innerHTML="";
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

}

var delFilesIndex=[];

$("#imgContent2").on("click ",".img-preview span",function(){
    $(this.parentNode).css("display","none");
    delFilesIndex.push($("#imgContent2 .img-preview").index(this.parentNode));
});


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
//ajax

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
document.getElementsByName("submit")[0].onclick=function(){
    var form=document.getElementsByTagName("form")[0];
    var formData=new FormData(form);
    var brand=$("input[name='brand']:checked").val();
    formData.append("brand",brand);
    formData.append("categories",categories);

    var files=getFilesDate();
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
                if(error['size']){
                    document.getElementById('size').innerText=error['size'];
                }

            }else{
                window.location="addProductionAtrr.php?id="+result['id'];
            }
        }
    };

    xhr.open("post","addProductionCheck.php",true);
    xhr.send(formData);

};


