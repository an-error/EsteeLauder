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